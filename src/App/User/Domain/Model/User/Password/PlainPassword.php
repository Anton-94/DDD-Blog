<?php

declare(strict_types=1);

namespace App\User\Domain\Model\User\Password;

use App\User\Domain\Exception\PasswordIsNotValidException;

class PlainPassword
{
    public const MIN_LENGTH = 8;

    private string $value;

    /** @throws PasswordIsNotValidException */
    public function __construct(string $password)
    {
        if (strlen($password) < self::MIN_LENGTH) {
            throw new PasswordIsNotValidException();
        }

        /* @todo validation */
        $this->value = $password;
    }

    public function value(): string
    {
        return $this->value;
    }
}
