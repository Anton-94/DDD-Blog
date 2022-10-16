<?php

declare(strict_types=1);

namespace App\User\Domain\Model\User;

class Email
{
    private string $value;

    public function __construct(string $email)
    {
        /* @todo validation */
        $this->value = $email;
    }

    public function value(): string
    {
        return $this->value;
    }
}
