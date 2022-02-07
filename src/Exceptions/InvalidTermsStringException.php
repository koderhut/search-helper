<?php

/*
 * This file is part of the KoderHut/SearchModel package.
 *
 *  (c)Denis-Florin Rendler (connect@rendler.me)
 *
 *  For the full copyright and license information, please view the LICENSE.md
 *  file that was distributed with this source code.
 */

declare(strict_types=1);

namespace KoderHut\SearchHelper\Exceptions;

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
