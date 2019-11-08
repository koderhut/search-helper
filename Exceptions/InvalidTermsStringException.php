<?php declare(strict_types=1);

namespace App\Domain\Search\Exceptions;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class InvalidTermsStringException extends \Exception
{
    public const EXC_CODE = 101001;
    private const MESSAGE = 'Invalid search terms string provided! Received: [%s]';

    public function __construct(string $terms, $code = self::EXC_CODE, \Throwable $previous = null)
    {
        parent::__construct(sprintf(self::MESSAGE, $terms), $code, $previous);
    }
}
