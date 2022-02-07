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

namespace KoderHut\SearchModel\Tests\Processor;

use KoderHut\SearchHelper\Model\SearchQuery;
use KoderHut\SearchHelper\Processor\QueryProcessor;
use KoderHut\SearchHelper\Processor\Worker\Terms as Terms;
use KoderHut\SearchHelper\Processor\Worker\WorkerInterface;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class QueryProcessorTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider workersProvider
     */
    public function testHandingOffProcessingToWorkers(WorkerInterface ...$workers)
    {
        $instance = new QueryProcessor(...$workers);

        $instance->handle(new SearchQuery('this is a test'));
    }

    public function workersProvider()
    {
        return [
            'single worker' => [new class() extends Terms {
                public function handle(SearchQuery $query): void {
                    Assert::assertEquals('this is a test', $query->query());
                }
            }],
            'unsupported worker' => [new class() extends Terms {
                public function supports(SearchQuery $searchQuery): bool
                {
                    Assert::assertEquals('this is a test', $searchQuery->query());
                    return false;
                }
            }],
        ];
    }
}
