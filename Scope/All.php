<?php declare(strict_types=1);

namespace App\Domain\Search\Scope;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class All implements ScopeInterface
{
    public function supports(string $type)
    {
        return false;
    }

    public function keys(): array
    {
        return ['name', 'keyword', 'description'];
    }
}
