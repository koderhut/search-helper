<?php declare(strict_types=1);

namespace App\Domain\Search\Model;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
interface TermInterface
{
    public function term(): string;

    public function __toString();
}
