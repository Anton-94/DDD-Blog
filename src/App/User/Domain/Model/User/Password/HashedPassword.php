<?php

declare(strict_types=1);

namespace App\User\Domain\Model\User\Password;

class HashedPassword
{
    private string $value;

    public function __construct(string $hashedPassword)
    {
        /* @todo validation */
        $this->value = $hashedPassword;
    }

    public function value(): string
    {
        return $this->value;
    }
}
