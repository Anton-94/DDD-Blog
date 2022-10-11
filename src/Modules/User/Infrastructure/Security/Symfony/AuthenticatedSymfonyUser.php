<?php

declare(strict_types=1);

namespace App\Modules\User\Infrastructure\Security\Symfony;

use App\Modules\Shared\Domain\ValueObject\Uuid;
use App\Modules\Shared\Infrastructure\Exception\InfrastructureException;
use App\Modules\User\Domain\Entity\User\User;
use App\Modules\User\Infrastructure\PasswordHasher\PasswordAuthenticatedUserInterface;
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

    /** @throws InfrastructureException */
    public function eraseCredentials()
    {
        throw InfrastructureException::create(__METHOD__, 'User does not has erase credentials.');
    }

    public function getUserIdentifier(): string
    {
        return $this->user->email()->value();
    }
}
