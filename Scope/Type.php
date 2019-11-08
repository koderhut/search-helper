<?php declare(strict_types=1);

namespace App\Domain\Search\Scope;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class Type implements ScopeInterface
{
    use ScopeTrait;

    private const SUPPORTED_KEYWORD = ['type'];
    private const KEYS = ['type'];
}
