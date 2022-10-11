<?php

declare(strict_types=1);

namespace App\User\Infrastructure\PasswordHasher;

use App\User\Domain\Entity\User\Password;
use App\User\Infrastructure\Security\Symfony\AuthenticatedSymfonyUser;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class PasswordHasher implements PasswordHasherInterface
{
    public function __construct(
        private readonly PasswordHasherFactoryInterface $passwordHasherFactory
    ) {
    }

    public function hash(string $password): Password
    {
        $passwordHasher = $this->passwordHasherFactory->getPasswordHasher(AuthenticatedSymfonyUser::class);

        return new Password($passwordHasher->hash($password));
    }
}
