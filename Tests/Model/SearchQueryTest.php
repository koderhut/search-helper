<?php
declare(strict_types=1);

namespace App\Domain\Search\Tests\Model;

use App\Domain\Search\Collection\Terms;
use App\Domain\Search\Model\SearchQuery;
use App\Domain\Search\Processor\ProcessorInterface;
use App\Domain\Search\Processor\QueryProcessor;
use App\Domain\Search\Processor\Worker\Scope;
use App\Domain\Search\Processor\Worker\Terms as TermsWorker;
use App\Domain\Search\Scope\Description;
use App\Domain\Search\Scope\Keyword;
use App\Domain\Search\Scope\Name;
use App\Domain\Search\Scope\ScopeInterface;
use PHPUnit\Framework\TestCase;

class SearchQueryTest extends TestCase
{

    /**
     * @test
     */
    public function testRetrieveSearchQueryAsString()
    {
        $instance = new SearchQuery('this is a test');

        $this->assertEquals('this is a test', $instance->query());
        $this->assertEquals('this is a test', $instance->toString());
    }

    /**
     * @test
     *
     * @dataProvider processorProvider
     */
    public function testProcessingASearchQuery(string $query, ProcessorInterface $proc, array $expected)
    {
        $instance = new SearchQuery($query);

        $instance->process($proc);

        $this->assertInstanceOf(ScopeInterface::class, $instance->scope());
        $this->assertEquals($expected['scope'], $instance->scope()->keys());

        $this->assertInstanceOf(Terms::class, $instance->terms());
        $this->assertEquals($expected['terms'], $instance->terms()->terms());
    }

    public function processorProvider()
    {
        $workers = [
            new TermsWorker(),
            new Scope(new Name(), new Keyword(), new Description())
        ];

        return [
            'all scope' => [
                'this is a string',
                new QueryProcessor(...$workers),
                ['scope' => ['name', 'keyword', 'description'], 'terms' => ['this', 'is', 'a', 'string']]
            ],
            'all scope with single term' => [
                '"this is a string"',
                new QueryProcessor(...$workers),
                ['scope' => ['name', 'keyword', 'description'], 'terms' => ['this is a string']]
            ],
            'name scope' => [
                'name: this is a string',
                new QueryProcessor(...$workers),
                ['scope' => ['name'], 'terms' => ['this', 'is', 'a', 'string']]
            ],
            'keyword scope' => [
                'kw: this is a string',
                new QueryProcessor(...$workers),
                ['scope' => ['keyword'], 'terms' => ['this', 'is', 'a', 'string']]
            ],
            'description scope' => [
                'desc: this is a string',
                new QueryProcessor(...$workers),
                ['scope' => ['description'], 'terms' => ['this', 'is', 'a', 'string']]
            ],
        ];
    }
}
