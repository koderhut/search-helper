<?php declare(strict_types=1);

namespace App\Domain\Search\Infrastructure\Support;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
interface ResultsSetInterface
{
    public function all(): array;
}
