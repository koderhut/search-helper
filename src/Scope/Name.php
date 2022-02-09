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

namespace KoderHut\SearchHelper\Scope;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class Name implements ScopeInterface
{
    use ScopeTrait;

    private const SUPPORTED_KEYWORD = ['name'];
    private const KEYS = ['name'];
    private const PRIORITY = 10;

}
