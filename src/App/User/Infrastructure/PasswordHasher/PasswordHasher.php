<?php

declare(strict_types=1);

namespace App\User\Infrastructure\PasswordHasher;

use App\User\Domain\Model\User\Password\HashedPassword;
use App\User\Domain\Model\User\Password\PlainPassword;
use App\User\Domain\Model\User\User;
use App\User\Domain\Service\UserPasswordHasherInterface;
use App\User\Infrastructure\Security\Symfony\AuthenticatedSymfonyUser;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class PasswordHasher implements UserPasswordHasherInterface
{
    public function __construct(
        private readonly PasswordHasherFactoryInterface $passwordHasherFactory
    ) {
    }

    public function hash(PlainPassword $password, User $user): HashedPassword
    {
        $passwordHasher = $this->passwordHasherFactory->getPasswordHasher(new AuthenticatedSymfonyUser($user));

        return new HashedPassword($passwordHasher->hash($password->value()));
    }
}
