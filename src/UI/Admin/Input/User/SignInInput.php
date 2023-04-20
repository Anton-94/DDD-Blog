<?php

declare(strict_types=1);

namespace UI\Admin\Input\User;

use Symfony\Component\Validator\Constraints as Assert;

class SignInInput
{
    #[Assert\NotBlank]
    private string $email;

    #[Assert\NotBlank]
    private string $password;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}

