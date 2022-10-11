<?php

declare(strict_types=1);

namespace App\Modules\User\Domain\Entity\User;

use App\Modules\User\Domain\Exception\PasswordIsNotValidException;

class Password
{
    private string $value;

    /** @throws PasswordIsNotValidException */
    public function __construct(string $password)
    {
        if (strlen($password) < 9) {
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
