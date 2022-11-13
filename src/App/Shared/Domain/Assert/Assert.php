<?php

declare(strict_types=1);

namespace App\Shared\Domain\Assert;

use App\User\Domain\Exception\EmailIsNotValidException;
use Webmozart\Assert\Assert as WebmozartAssert;
use Webmozart\Assert\InvalidArgumentException;

class Assert
{
    public static function email($value, $message = ''): void
    {
        self::overrideException(fn () => WebmozartAssert::email($value, $message), EmailIsNotValidException::class);
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
