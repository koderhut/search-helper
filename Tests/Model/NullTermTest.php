<?php declare(strict_types=1);

namespace App\Domain\Search\Tests\Model;

use App\Domain\Search\Model\NullTerm;
use App\Domain\Search\Model\TermInterface;
use PHPUnit\Framework\TestCase;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class NullTermTest extends TestCase
{

    /**
     * @test
     */
    public function testAlwaysReturningAnEmptyString()
    {
        $instance = new NullTerm();

        $this->assertInstanceOf(TermInterface::class, $instance);
        $this->assertEquals('', $instance->term());
        $this->assertEquals('', $instance->__toString());
   }
}
