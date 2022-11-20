<?php

declare(strict_types=1);

namespace App\User\Domain\Model\User;

use App\Shared\Domain\Assert\Assert;
use App\User\Domain\Exception\EmailIsNotValidException;

class Email
{
    private string $value;

    /**
     * @throws EmailIsNotValidException
     */
    public function __construct(string $email)
    {
        Assert::email($email, EmailIsNotValidException::class);
        $this->value = $email;
    }

    public function value(): string
    {
        return $this->value;
    }
}
