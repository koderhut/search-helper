<?php declare(strict_types=1);

namespace App\Domain\Search\Model;

use App\Domain\Search\Collection\Terms;
use App\Domain\Search\Infrastructure\Support\QueryBuilderInterface;
use App\Domain\Search\Infrastructure\Support\ResultsSetInterface;
use App\Domain\Search\Scope\ScopeInterface;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class Search
{
    /**
     * @var ScopeInterface
     */
    private $scope;

    /**
     * @var Terms
     */
    private $terms;

    /**
     * @var ResultsSetInterface
     */
    private $results;

    public function __construct(ScopeInterface $scope, Terms $terms)
    {
        $this->scope = $scope;
        $this->terms = $terms;
    }

    public function exec(QueryBuilderInterface $builder)
    {
        $this->results = $builder->exec($this);
    }

    public function terms(): array
    {
        return $this->terms->terms();
    }

    public function scopes(): array
    {
        return $this->scope->keys();
    }

    public function results(): ResultsSetInterface
    {
        return $this->results;
    }
}
