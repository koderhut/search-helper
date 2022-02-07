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
interface ScopeInterface
{
    /**
     * Guard check to see if implementation supports the current operation
     */
    public function supports(string $type): bool;

    /**
     * List of keys to be used as column names
     */
    public function keys(): iterable;

    /**
     * Determine the priority of the scope processor
     */
    public function priority(): int;
}
