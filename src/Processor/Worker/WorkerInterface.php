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

namespace KoderHut\SearchHelper\Processor\Worker;

use KoderHut\SearchHelper\Model\SearchQuery;
use KoderHut\SearchHelper\Processor\ProcessorInterface;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
interface WorkerInterface extends ProcessorInterface
{
    public function supports(SearchQuery $searchQuery): bool;

    public function name(): string;
}
