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

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
interface TermInterface
{
    public function term(): string;

    public function __toString();
}
