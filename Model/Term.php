<?php declare(strict_types=1);

namespace App\Domain\Search\Model;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class Term implements TermInterface
{
    /**
     * @var string
     */
    private $term;

    public function __construct(string $term)
    {
        $this->term = $term;
    }

    /**
     * @return string
     */
    public function term(): string
    {
        return $this->term;
    }

    public function __toString()
    {
        return (string) $this->term;
    }
}
