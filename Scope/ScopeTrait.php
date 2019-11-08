<?php declare(strict_types=1);

namespace App\Domain\Search\Scope;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
trait ScopeTrait
{
    public function supports(string $type)
    {
        return (bool) in_array($type, self::SUPPORTED_KEYWORD);
    }

    public function keys(): array
    {
        return (array) self::KEYS;
    }
}
