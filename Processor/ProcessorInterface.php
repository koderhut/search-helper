<?php declare(strict_types=1);

namespace App\Domain\Search\Processor;

use App\Domain\Search\Model\SearchQuery;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
interface ProcessorInterface
{
    public function handle(SearchQuery $items);
}
