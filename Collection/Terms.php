<?php declare(strict_types=1);

namespace App\Domain\Search\Collection;

use App\Domain\Search\Model\NullTerm;
use App\Domain\Search\Model\TermInterface;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class Terms
{
    /**
     * @var array
     */
    private $terms;

    public function __construct(TermInterface ...$terms)
    {
        foreach ($terms as $term) {
            $this->add($term);
        }
    }

    /**
     * @return array
     */
    public function terms(): array
    {
        return $this->terms;
    }

    public function add(TermInterface $term)
    {
        if ($term instanceof NullTerm) {
            return;
        }

        $this->terms[] = $term;
    }
}
