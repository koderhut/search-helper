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
trait ScopeTrait
{
    public function supports(string $type): bool
    {
        return (bool) in_array($type, self::SUPPORTED_KEYWORD);
    }

    public function keys(): array
    {
        return (array) self::KEYS;
    }

    public function priority(): int
    {
        return (int) self::PRIORITY;
    }
}
