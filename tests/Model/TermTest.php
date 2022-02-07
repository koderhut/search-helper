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

namespace KoderHut\SearchHelper\Tests\Model;

use KoderHut\SearchHelper\Model\Term;
use KoderHut\SearchHelper\Model\TermInterface;
use PHPUnit\Framework\TestCase;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class TermTest extends TestCase
{

    /**
     * @test
     */
    public function testAlwaysReturningProperString()
    {
        $instance = new Term('unu');

        $this->assertInstanceOf(TermInterface::class, $instance);
        $this->assertEquals('unu', $instance->term());
        $this->assertEquals('unu', $instance->__toString());
   }
}
