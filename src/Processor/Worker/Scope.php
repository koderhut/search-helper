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

    /**
     * @var ScopeInterface[]
     */
    private array $scopes = [];

    public function __construct(ScopeInterface ...$scopes)
    {
        foreach ($scopes as $scope) {
            $priority = $this->findNextAvailablePriority($scope->priority());

            $this->scopes[$priority] = $scope;
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
        $type = substr($items->toString(), 0, $typeDelimiterPosition) ?? '';

        foreach ($this->scopes as $searchScope) {
            if ($searchScope->supports($type)) {
                $items->setScope($searchScope);

                return;
            }
        }

        throw new UnknownSearchScopeException($type);
    }

    public function supports(SearchQuery $searchQuery): bool
    {
        return (bool)method_exists($searchQuery, 'setScope');
    }

    public function name(): string
    {
        return 'scope';
    }

    protected function findNextAvailablePriority(int $startPriority): int
    {
        $iterations = 1;
        while (isset($this->scopes[$startPriority])) {
            $startPriority++;
            $iterations++;

            if (1000 <= $iterations) {
                throw new \LogicException('Unable to find next available priority! Tried more than 1000 iterations');
            }
        }

        return $startPriority;
    }
}
