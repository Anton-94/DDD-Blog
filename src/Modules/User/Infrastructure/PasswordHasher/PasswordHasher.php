<?php

declare(strict_types=1);

namespace App\Modules\User\Infrastructure\PasswordHasher;

use App\Modules\User\Domain\Entity\User\Password;
use App\Modules\User\Infrastructure\Security\Symfony\AuthenticatedSymfonyUser;
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