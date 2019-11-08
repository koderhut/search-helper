<?php declare(strict_types=1);

namespace App\Domain\Search\Processor\Worker;

use App\Domain\Search\Model\SearchQuery;
use App\Domain\Search\Exceptions\UnknownSearchScopeException;
use App\Domain\Search\Scope\All;
use App\Domain\Search\Scope\ScopeInterface;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class Scope implements WorkerInterface
{
    private const TYPE_DELIMITER = ':';
    private const TYPE_DEFAULT = All::class;

    /**
     * @var ScopeInterface[]
     */
    private $scopes;

    public function __construct(ScopeInterface ...$types)
    {
        $this->scopes = $types ?? [];
    }

    public function handle(SearchQuery $query)
    {
        $typeDelimiterPosition = (int) strpos($query->toString(), self::TYPE_DELIMITER, 0);

        if (!$typeDelimiterPosition) {
            $default = self::TYPE_DEFAULT;
            $query->setScope(new $default());

            return;
        }

        $type = substr($query->toString(), 0, $typeDelimiterPosition);

        foreach ($this->scopes as $searchScope) {
            if ($searchScope->supports($type)) {
                $query->setScope($searchScope);

                return;
            }
        }

        throw new UnknownSearchScopeException($type);
    }

    public function supports(SearchQuery $searchQuery)
    {
        return (bool) method_exists($searchQuery, 'setScope');
    }

    public function name(): string
    {
        return 'scope';
    }
}
