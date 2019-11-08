<?php declare(strict_types=1);

namespace App\Domain\Search\Actions;

use App\Domain\Search\Infrastructure\Support\QueryBuilderInterface;
use App\Domain\Search\Model\Search as SearchModel;
use App\Domain\Search\Model\SearchQuery;
use App\Domain\Search\Processor\ProcessorInterface;
use App\Domain\Search\Processor\QueryProcessor;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class Search
{
    /**
     * @var ProcessorInterface
     */
    private $queryProcessor;

    /**
     * @var QueryBuilderInterface
     */
    private $dataQueryBuilder;

    /**
     * @var SearchModel
     */
    private $search;

    public function __construct(QueryBuilderInterface $builder, ProcessorInterface $queryProcessor = null)
    {
        $this->dataQueryBuilder = $builder;
        $this->queryProcessor = $queryProcessor ?? new QueryProcessor();
    }

    public function search(SearchQuery $query): self
    {
        $query->process($this->queryProcessor);

        $this->search = new SearchModel($query->scope(), $query->terms());

        return $this;
    }

    public function results()
    {
        $this->search->exec($this->dataQueryBuilder);

        return $this->search->results();
    }


}
