<?php

declare(strict_types=1);

namespace App\Modules\User\Domain\Entity\User;

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
