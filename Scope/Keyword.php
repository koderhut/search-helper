<?php declare(strict_types=1);

namespace App\Domain\Search\Scope;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class Keyword implements ScopeInterface
{
    use ScopeTrait;

    private const SUPPORTED_KEYWORD = ['kw', 'keyword'];
    private const KEYS = ['keyword'];
}
