<?php declare(strict_types=1);

namespace App\Domain\Search\Tests\Collection;

use App\Domain\Search\Collection\Terms;
use App\Domain\Search\Model\NullTerm;
use App\Domain\Search\Model\Term;
use PHPUnit\Framework\TestCase;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class TermsTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider termsGenerator
     */
    public function testConstructingATermsCollection(array $terms, int $count)
    {
        $this->assertInstanceOf(Terms::class, new Terms(), 'Error creating Terms class with empty __construct');

        $instance = new Terms(...$terms);

        $this->assertInstanceOf(Terms::class, $instance);
        $this->assertIsArray($instance->terms());
        $this->assertCount($count, $instance->terms());
    }

    /**
     * @test
     *
     * @dataProvider termsGenerator
     */
    public function testAddingTermsToCollection(array $terms, int $count)
    {
        $instance = new Terms();

        foreach ($terms as $term) {
            $instance->add($term);
        }

        $this->assertCount($count, $instance->terms());
    }

    public function termsGenerator()
    {
        return [
            'two term objects collection' => [[new Term('one'), new Term('two')], 2],
            'one term object and one nullterm object collection' => [[new Term('one'), new NullTerm()], 1],
        ];
    }
}
