<?php declare(strict_types=1);

namespace App\Domain\Search\Infrastructure\Support;

use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class ResultsSet implements Jsonable, ResultsSetInterface
{
    /**
     * @var Collection
     */
    private $items;

    public function __construct(Collection $items)
    {
        $this->items = $items;
    }

    public function all(): array
    {
        return $this->items->all();
    }

    public function toJson($options = 0)
    {
        return $this->items->toJson();
    }
}
