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

namespace KoderHut\SearchHelper\Services;

use KoderHut\SearchHelper\Helper\Context\ContextInterface;
use KoderHut\SearchHelper\Infrastructure\Contracts\DataStoreAdapter;
use KoderHut\SearchHelper\Model\ResultsSetInterface;
use KoderHut\SearchHelper\Model\SearchQuery;
use KoderHut\SearchHelper\Processor\ProcessorInterface;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class Search
{
    public function __construct(
        private DataStoreAdapter $dataQueryBuilder,
        private ProcessorInterface $queryProcessor,
    ) {}

    public function search(SearchQuery $query, ?ContextInterface $context = null): ResultsSetInterface
    {
        $this->queryProcessor->handle($query);

        return $this->dataQueryBuilder->query($query, $context);
    }
}
