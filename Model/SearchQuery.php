<?php declare(strict_types=1);

namespace App\Domain\Search\Model;

use App\Domain\Search\Collection\Terms;
use App\Domain\Search\Processor\ProcessorInterface;
use App\Domain\Search\Scope\ScopeInterface;
use App\Domain\Search\Support\VisitedInterface;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class SearchQuery implements VisitedInterface
{
    /**
     * @var string
     */
    private $query;

    /**
     * @var ScopeInterface
     */
    private $scope;

    /**
     * @var Terms
     */
    private $terms;

    public function __construct(string $query)
    {
        $this->query = $query;
    }

    public function process(ProcessorInterface $processor)
    {
        $processor->handle($this);
    }

    public function query(): string
    {
        return $this->query;
    }

    public function toString()
    {
        return $this->query;
    }

    public function setScope(ScopeInterface $scope)
    {
        $this->scope = $scope;
    }

    public function setTerms(Terms $terms)
    {
        $this->terms = $terms;
    }

    public function scope(): ScopeInterface
    {
        return $this->scope;
    }

    public function terms(): Terms
    {
        return $this->terms;
    }
}
