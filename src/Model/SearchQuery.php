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

namespace KoderHut\SearchHelper\Model;

use KoderHut\SearchHelper\Model\Collection\Terms;
use KoderHut\SearchHelper\Scope\ScopeInterface;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class SearchQuery
{
    private string $query;
    private ScopeInterface $scope;
    private Terms $terms;

    public function __construct(string $query)
    {
        $this->query = $query;
    }

    public function query(): string
    {
        return $this->query;
    }

    public function toString(): string
    {
        return $this->query;
    }

    public function setScope(ScopeInterface $scope): void
    {
        $this->scope = $scope;
    }

    public function getScope(): ScopeInterface
    {
        return $this->scope;
    }

    public function setTerms(Terms $terms): void
    {
        $this->terms = $terms;
    }

    public function getTerms(): Terms
    {
        return $this->terms;
    }

    public function scope(): iterable
    {
        return $this->scope->keys();
    }

    public function terms(): iterable
    {
        return $this->terms->terms();
    }
}
