<?php declare(strict_types=1);

namespace App\Domain\Search\Scope;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class Description implements ScopeInterface
{
    use ScopeTrait;

    private const SUPPORTED_KEYWORD = ['desc', 'description'];
    private const KEYS = ['description'];

}
