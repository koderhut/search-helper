<?php

/*
 * This file is part of the KoderHut/SearchModel package.
 *
 *  (c)Denis-Florin Rendler (connect@rendler.me)
 *
 *  For the full copyright and license information, please view the LICENSE.md
 *  file that was distributed with this source code.
 */

declare(strict_types=1);

namespace KoderHut\SearchHelper\Processor\Worker;

use KoderHut\SearchHelper\Exceptions\UnknownSearchScopeException;
use KoderHut\SearchHelper\Model\SearchQuery;
use KoderHut\SearchHelper\Scope\All;
use KoderHut\SearchHelper\Scope\ScopeInterface;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class Scope implements WorkerInterface
{
    private const TYPE_DELIMITER        = ':';
    private const TYPE_DEFAULT          = All::class;
    private const NO_DELIMITER_FOUND    = 0;

    /**
     * @var ScopeInterface[]
     */
    private array $scopes = [];

    public function __construct(ScopeInterface ...$scopes)
    {
        foreach ($scopes as $scope) {
            $this->scopes[$scope->priority()] = $scope;
        }
        krsort($this->scopes, SORT_NUMERIC);
    }

    public static function fromIterable(iterable $scopes): static
    {
        return new static(...$scopes);
    }

    /**
     * @throws UnknownSearchScopeException
     */
    public function handle(SearchQuery $items): void
    {
        $typeDelimiterPosition = (int)strpos($items->toString(), self::TYPE_DELIMITER);

//        if (self::NO_DELIMITER_FOUND === $typeDelimiterPosition) {
//            $default = self::TYPE_DEFAULT;
//            $items->setScope(new $default());
//
//            return;
//        }

        $type = substr($items->toString(), 0, $typeDelimiterPosition) ?? '';

        foreach ($this->scopes as $searchScope) {
            if ($searchScope->supports($type)) {
                $items->setScope($searchScope);

                break;
            }
        }

//        throw new UnknownSearchScopeException($type);
    }

    public function supports(SearchQuery $searchQuery): bool
    {
        return (bool)method_exists($searchQuery, 'setScope');
    }

    public function name(): string
    {
        return 'scope';
    }
}
