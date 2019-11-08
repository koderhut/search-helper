<?php declare(strict_types=1);

namespace App\Domain\Search\Tests\Processor;

use App\Domain\Search\Model\SearchQuery;
use App\Domain\Search\Processor\QueryProcessor;
use App\Domain\Search\Processor\Worker\Terms as Terms;
use App\Domain\Search\Processor\Worker\WorkerInterface;
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
                public function handle(SearchQuery $query) {
                    Assert::assertEquals('this is a test', $query->query());
                }
            }],
            'unsupported worker' => [new class() extends Terms {
                public function supports(SearchQuery $searchQuery)
                {
                    Assert::assertEquals('this is a test', $searchQuery->query());
                    return false;
                }
            }],
        ];
    }
}
