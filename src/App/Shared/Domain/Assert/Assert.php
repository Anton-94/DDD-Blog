<?php

declare(strict_types=1);

namespace App\Shared\Domain\Assert;

use Webmozart\Assert\Assert as WebmozartAssert;
use Webmozart\Assert\InvalidArgumentException;

class Assert
{
    public static function email($value, string $exceptionFQCN, $message = ''): void
    {
        self::overrideException(fn () => WebmozartAssert::email($value, $message), $exceptionFQCN);
    }

    public static function overrideException(callable $assert, string $expectedException): void
    {
        try {
            $assert();
        } catch (InvalidArgumentException $exception) {
            throw new $expectedException($exception->getMessage());
        }
    }
}
