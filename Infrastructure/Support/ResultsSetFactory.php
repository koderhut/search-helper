<?php declare(strict_types=1);

namespace App\Domain\Search\Infrastructure\Support;

use Illuminate\Support\Collection;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class ResultsSetFactory
{
    public function __invoke(Collection $items): ResultsSetInterface
    {
        return new ResultsSet($items);
    }
}
