<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use JsonSerializable;
use Ramsey\Uuid\Uuid as RamseyUuid;
use Stringable;

class Uuid implements Stringable, JsonSerializable
{
    public function __construct(
        private readonly string $value
    ) {
    }

    public static function new(): static
    {
        return new static(RamseyUuid::uuid4()->toString());
    }

    public static function from(Uuid|string $uuid): static
    {
        return new static((string) $uuid);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }
}
