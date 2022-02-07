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
class UnknownSearchScopeException extends \Exception
{
    public const EXC_CODE = 101002;
    private const MESSAGE = 'Unknown search type provided! Received: [%s]';

    public function __construct(string $type, $code = self::EXC_CODE, \Throwable $previous = null)
    {
        parent::__construct(sprintf(self::MESSAGE, $type), $code, $previous);
    }
}
