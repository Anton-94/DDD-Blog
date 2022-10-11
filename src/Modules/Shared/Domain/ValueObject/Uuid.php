<?php

declare(strict_types=1);

namespace App\Modules\Shared\Domain\ValueObject;

use Ramsey\Uuid\Uuid as RamseyUuid;
use Stringable;

class Uuid implements Stringable
{
    public function __construct(
        private readonly string $value
    ) {
    }

    public static function new(): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}