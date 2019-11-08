<?php declare(strict_types=1);

namespace App\Domain\Search\Processor\Worker;

use App\Domain\Search\Model\SearchQuery;
use App\Domain\Search\Processor\ProcessorInterface;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
interface WorkerInterface extends ProcessorInterface
{
    public function supports(SearchQuery $searchQuery);

    public function name(): string;
}
