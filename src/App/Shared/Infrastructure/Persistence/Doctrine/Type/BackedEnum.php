<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Type;

enum BackedEnum
{
    case STRING;
    case INT;

    public function cast(mixed $value): int|string
    {
        return match ($this) {
            self::STRING => (string) $value,
            self::INT => (int) $value,
        };
    }
}
