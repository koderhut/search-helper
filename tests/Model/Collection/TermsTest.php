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

namespace KoderHut\SearchModel\Tests\Model\Collection;

use KoderHut\SearchHelper\Model\Collection\Terms;
use KoderHut\SearchHelper\Model\NullTerm;
use KoderHut\SearchHelper\Model\Term;
use PHPUnit\Framework\TestCase;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class TermsTest extends TestCase
{
    /**
     * @dataProvider termsGenerator
     */
    public function testItCanConstructATermsCollection(array $terms, int $count)
    {
        $this->assertInstanceOf(Terms::class, new Terms(), 'Error creating Terms class with empty __construct');

        $instance = new Terms(...$terms);

        $this->assertInstanceOf(Terms::class, $instance);
        $this->assertIsArray($instance->terms());
        $this->assertCount($count, $instance->terms());
    }

    /**
     * @dataProvider termsGenerator
     */
    public function testItCanDynamicallyAddTermsToCollection(array $terms, int $count)
    {
        $instance = new Terms();

        foreach ($terms as $term) {
            $instance->add($term);
        }

        $this->assertCount($count, $instance->terms());
    }

    /**
     * @see testItCanConstructATermsCollection
     * @see testItCanDynamicallyAddTermsToCollection
     */
    public function termsGenerator(): \Generator
    {
        yield 'two term objects collection' => [[new Term('one'), new Term('two')], 2];

        yield 'one term object and one nullterm object collection' => [[new Term('one'), new NullTerm()], 1];
    }
}
