<?php declare(strict_types=1);

namespace App\Domain\Search\Infrastructure\Support;

use App\Domain\Search\Model\Search;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
interface QueryBuilderInterface
{
    public function exec(Search $params);
}
