<?php

declare(strict_types=1);

namespace App\User\Domain\Factory;

use App\Shared\Domain\ValueObject\Uuid;
use App\User\Domain\Model\User\Email;
use App\User\Domain\Model\User\Password\PlainPassword;
use App\User\Domain\Model\User\User;
use App\User\Domain\Service\UserPasswordHasherInterface;

class UserFactory
{
    public function __construct(
        private readonly UserPasswordHasherInterface $userPasswordHasher
    ) {
    }

    public function create(Uuid $uuid, Email $email, PlainPassword $password): User
    {
        $user = new User($uuid, $email);
        $user->setPassword($password, $this->userPasswordHasher);

        return $user;
    }
}
