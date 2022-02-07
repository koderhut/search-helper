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

namespace KoderHut\SearchModel\Tests\Model;

use KoderHut\SearchHelper\Model\Collection\Terms;
use KoderHut\SearchHelper\Model\SearchQuery;
use KoderHut\SearchHelper\Processor\ProcessorInterface;
use KoderHut\SearchHelper\Processor\QueryProcessor;
use KoderHut\SearchHelper\Processor\Worker\Scope;
use KoderHut\SearchHelper\Processor\Worker\Terms as TermsWorker;
use KoderHut\SearchHelper\Scope\Name;
use KoderHut\SearchHelper\Scope\ScopeInterface;
use PHPUnit\Framework\TestCase;

class SearchQueryTest extends TestCase
{
    public function testRetrieveSearchQueryAsString(): void
    {
        $instance = new SearchQuery('this is a test');

        $this->assertEquals('this is a test', $instance->query());
        $this->assertEquals('this is a test', $instance->toString());
    }

//    public function testProcessingASearchQuery(string $query, array $expected): void
//    {
//        $this->markTestSkipped();
//        $instance = new SearchQuery($query);
//
//        $this->assertInstanceOf(ScopeInterface::class, $instance->scope());
//        $this->assertEquals($expected['scope'], $instance->scope()->keys());
//
//        $this->assertInstanceOf(Terms::class, $instance->terms());
//        $this->assertEquals($expected['terms'], $instance->terms()->terms());
//    }

    public function processorProvider()
    {
        $workers = [
            new TermsWorker(),
            new Scope(new Name(), new Keyword(), new Description())
        ];

        return [
            'all scope' => [
                'this is a string',
                ['scope' => ['name', 'keyword', 'description'], 'terms' => ['this', 'is', 'a', 'string']]
            ],
            'all scope with single term' => [
                '"this is a string"',
                ['scope' => ['name', 'keyword', 'description'], 'terms' => ['this is a string']]
            ],
            'name scope' => [
                'name: this is a string',
                ['scope' => ['name'], 'terms' => ['this', 'is', 'a', 'string']]
            ],
            'keyword scope' => [
                'kw: this is a string',
                ['scope' => ['keyword'], 'terms' => ['this', 'is', 'a', 'string']]
            ],
            'description scope' => [
                'desc: this is a string',
                ['scope' => ['description'], 'terms' => ['this', 'is', 'a', 'string']]
            ],
        ];
    }
}
