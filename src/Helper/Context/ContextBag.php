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
class ContextBag implements ContextInterface
{
    public function __construct(
        private array $bag = []
    ) {}

    public function get(string|int $identifier, mixed $default = null): mixed
    {
        if (isset($this->bag[$identifier])) {
            return $this->bag[$identifier];
        }

        return $default;
    }

    public function has(string $identifier): bool
    {
        return isset($this->bag[$identifier]);
    }
}
