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

namespace KoderHut\SearchHelper\Helper\Context;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
interface ContextInterface
{
    /**
     * Fetch the payload from context based on the identifier
     */
    public function get(string|int $identifier, mixed $default = null): mixed;

    /**
     * Check if payload exists based on the identifier
     *
     * @param string $identifier
     *
     * @return bool
     */
    public function has(string $identifier): bool;
}
