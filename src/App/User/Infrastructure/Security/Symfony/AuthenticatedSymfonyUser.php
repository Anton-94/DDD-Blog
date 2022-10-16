<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Security\Symfony;

use App\Shared\Domain\ValueObject\Uuid;
use App\Shared\Infrastructure\Exception\InfrastructureException;
use App\User\Domain\Model\User\User;
use App\User\Infrastructure\PasswordHasher\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthenticatedSymfonyUser implements UserInterface, PasswordAuthenticatedUserInterface
{
    public function __construct(
        private readonly User $user
    ) {
    }

    public function domainUser(): User
    {
        return $this->user;
    }

    public function getPassword(): ?string
    {
        return $this->user->password()->value();
    }

    public function getRoles(): array
    {
        return $this->user->roles();
    }

    public function uuid(): Uuid
    {
        return $this->user->exposedId();
    }

    public function eraseCredentials()
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->user->email()->value();
    }
}
