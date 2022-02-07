<?php

/*
 * This file is part of the KoderHut/SearchModel package.
 *
 *  (c)Denis-Florin Rendler (connect@rendler.me)
 *
 *  For the full copyright and license information, please view the LICENSE.md
 *  file that was distributed with this source code.
 */

declare(strict_types=1);

namespace KoderHut\SearchHelper\Processor;

use KoderHut\SearchHelper\Model\SearchQuery;
use KoderHut\SearchHelper\Processor\Worker\WorkerInterface;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class QueryProcessor implements ProcessorInterface
{
    /**
     * @var WorkerInterface[]
     */
    private array $workers;

    public function __construct(WorkerInterface ...$workers)
    {
        $this->workers = $workers;
    }

    public static function fromIterable(iterable $workers): static
    {
        return new static(...$workers);
    }

    public function handle(SearchQuery $items): void
    {
        foreach ($this->workers as $worker) {
            if (!$worker->supports($items)) {
                continue;
            }

            $worker->handle($items);
        }
    }
}
