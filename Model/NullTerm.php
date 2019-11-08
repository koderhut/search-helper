<?php declare(strict_types=1);

namespace App\Domain\Search\Model;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class NullTerm implements TermInterface
{
    public function term(): string
    {
        // added for interface compliance
        return '';
    }

    public function __toString()
    {
        // added for interface compliance
        return '';
    }
}
