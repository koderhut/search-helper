<?php declare(strict_types=1);

namespace App\Domain\Search\Tests\Actions;

use App\Domain\Search\Collection\Terms;
use App\Domain\Search\Infrastructure\Db\Query\Builder;
use App\Domain\Search\Infrastructure\Support\ResultsSet;
use App\Domain\Search\Infrastructure\Support\ResultsSetInterface;
use App\Domain\Search\Model\Search;
use App\Domain\Search\Model\Term;
use App\Domain\Search\Scope\All;
use App\Domain\Search\Scope\Name;
use App\Domain\Search\Scope\ScopeInterface;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class SearchTest extends TestCase
{

    /**
     * @test
     *
     * @dataProvider scopeAndTermsProvider
     */
    public function testExecutingASearchOnAllScope(ScopeInterface $scope, Terms $terms)
    {
        $instance = new Search($scope, $terms);
        $builder = $this->prophesize(Builder::class);
        $builder->exec($instance)->willReturn(new ResultsSet($this->prophesize(Collection::class)->reveal()));

        $instance->exec($builder->reveal());
        $results = $instance->results();

        $this->assertInstanceOf(ResultsSetInterface::class, $results);
    }

    /**
     * @test
     *
     * @dataProvider scopeAndTermsProvider
     */
    public function testScopeReturnArrayOfScopeKeys(ScopeInterface $scope, Terms $terms)
    {
        $instance = new Search($scope, $terms);

        $this->assertIsArray($instance->scopes());
        $this->assertEquals(['name', 'keyword', 'description'], $instance->scopes());
    }

    /**
     * @test
     *
     * @dataProvider scopeAndTermsProvider
     */
    public function testTermsReturnsArrayOfTermObjects(ScopeInterface $scope, Terms $terms)
    {
        $instance = new Search($scope, $terms);

        $this->assertIsArray($instance->terms());
        $this->assertInstanceOf(Term::class, $instance->terms()[0]);
        $this->assertEquals('unu', $instance->terms()[0]->term());
    }

    public function scopeAndTermsProvider()
    {
        return [
            'all scope' => [new All(), new Terms(new Term('unu'))],
        ];
    }
}
