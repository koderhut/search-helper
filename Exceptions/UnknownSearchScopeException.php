<?php declare(strict_types=1);

namespace App\Domain\Search\Exceptions;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class UnknownSearchScopeException extends \Exception
{
    public const EXC_CODE = 101002;
    private const MESSAGE = 'Unknown search type provided! Received: [%s]';

    public function __construct(string $type, $code = self::EXC_CODE, \Throwable $previous = null)
    {
        parent::__construct(sprintf(self::MESSAGE, $type), $code, $previous);
    }
}
