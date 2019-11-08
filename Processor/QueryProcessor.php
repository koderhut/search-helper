<?php declare(strict_types=1);

namespace App\Domain\Search\Processor;

use App\Domain\Search\Model\SearchQuery;
use App\Domain\Search\Processor\Worker\WorkerInterface;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class QueryProcessor implements ProcessorInterface
{
    /**
     * @var WorkerInterface[]
     */
    private $workers;

    public function __construct(WorkerInterface ...$workers)
    {
        $this->workers = $workers;
    }

    public function handle(SearchQuery $searchQuery)
    {
        foreach ($this->workers as $worker) {
            if (!$worker->supports($searchQuery)) {
                continue;
            }
            $worker->handle($searchQuery);
        }
    }
}
