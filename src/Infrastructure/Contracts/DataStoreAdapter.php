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

namespace KoderHut\SearchHelper\Infrastructure\Contracts;

use KoderHut\SearchHelper\Helper\Context\ContextInterface;
use KoderHut\SearchHelper\Model\ResultsSetInterface;
use KoderHut\SearchHelper\Model\SearchQuery;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
interface DataStoreAdapter
{
    public const FIRST_RESULT  = 'first_result';
    public const LIMIT_RESULTS = 'limit_results';
    public const ORDER_RESULT  = 'order';

    public function query(SearchQuery $items, ?ContextInterface $context = null): ResultsSetInterface;
}
