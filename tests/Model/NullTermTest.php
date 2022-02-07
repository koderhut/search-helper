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

use KoderHut\SearchHelper\Model\NullTerm;
use KoderHut\SearchHelper\Model\TermInterface;
use PHPUnit\Framework\TestCase;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class NullTermTest extends TestCase
{
    public function testAlwaysReturningAnEmptyString(): void
    {
        $instance = new NullTerm();

        $this->assertInstanceOf(TermInterface::class, $instance);
        $this->assertEquals('', $instance->term());
        $this->assertEquals('', $instance->__toString());
   }
}
