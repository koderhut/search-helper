<?php declare(strict_types=1);

namespace App\Domain\Search\Tests\Model;

use App\Domain\Search\Model\Term;
use App\Domain\Search\Model\TermInterface;
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
