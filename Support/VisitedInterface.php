<?php declare(strict_types=1);

namespace App\Domain\Search\Support;

use App\Domain\Search\Processor\ProcessorInterface;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
interface VisitedInterface
{
    public function process(ProcessorInterface $processor);
}
