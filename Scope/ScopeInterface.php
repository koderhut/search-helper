<?php declare(strict_types=1);

namespace App\Domain\Search\Scope;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
interface ScopeInterface
{
    public function supports(string $type);

    public function keys();
}
