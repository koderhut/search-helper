<?php declare(strict_types=1);

namespace App\Domain\Search\Infrastructure\Db\Query;

use App\Domain\Search\Infrastructure\Support\QueryBuilderInterface;
use App\Domain\Search\Infrastructure\Support\ResultsSetFactory;
use App\Domain\Search\Infrastructure\Support\ResultsSetInterface;
use App\Domain\Search\Model\Search;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class Builder implements QueryBuilderInterface
{
    /**
     * @var EloquentBuilder
     */
    private $db;

    /**
     * @var ResultsSetFactory
     */
    private $resultsFactory;

    public function __construct(EloquentBuilder $db, ResultsSetFactory $resultsFactory)
    {
        $this->db = $db;
        $this->resultsFactory = $resultsFactory;
    }

    public function exec(Search $params): ResultsSetInterface
    {
        $this->db->where($this->mapWhereClause($params));

        return ($this->resultsFactory)($this->db->get());
    }

    private function mapWhereClause(Search $params)
    {
        $mapped = array();

        foreach ($params->scopes() as $scope) {
            foreach ($params->terms() as $term) {
                $mapped[] = [$scope, 'like', "%${term}%", 'or'];
            }
        }

        return $mapped;
    }
}
