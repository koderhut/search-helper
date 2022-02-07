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

use Stringable;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class Term implements TermInterface, Stringable
{

    public function __construct(
        private string $term,
    ) {}

    /**
     * @return string
     */
    public function term(): string
    {
        return $this->term;
    }

    public function __toString(): string
    {
        return (string) $this->term;
    }
}
