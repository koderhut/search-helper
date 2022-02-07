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

namespace KoderHut\SearchHelper\Model\Collection;

use KoderHut\SearchHelper\Model\NullTerm;
use KoderHut\SearchHelper\Model\TermInterface;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class Terms
{
    private array $terms;

    public function __construct(TermInterface ...$terms)
    {
        foreach ($terms as $term) {
            $this->add($term);
        }
    }

    public function terms(): array
    {
        return $this->terms;
    }

    public function add(TermInterface $term)
    {
        if ($term instanceof NullTerm) {
            return;
        }

        $this->terms[] = $term;
    }
}
