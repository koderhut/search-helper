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

class IterableResultSet implements ResultsSetInterface, \Iterator
{
    public function __construct(
        private iterable $set,
    ) {}

    public function asArray(): iterable
    {
        return $this->set;
    }

    public function current(): mixed
    {
        return current($this->set);
    }

    public function next(): void
    {
        next($this->set);
    }

    public function key(): mixed
    {
        return key($this->set);
    }

    public function valid(): bool
    {
        return isset($this->set[key($this->set)]);
    }

    public function rewind(): void
    {
        reset($this->set);
    }
}
