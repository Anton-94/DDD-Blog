<?php

declare(strict_types=1);

namespace App\User\Domain\Factory;

use App\Shared\Domain\ValueObject\Uuid;
use App\User\Domain\Exception\EmailIsNotValidException;
use App\User\Domain\Exception\PasswordIsNotValidException;
use App\User\Domain\Exception\UserAlreadyExistsException;
use App\User\Domain\Model\User\Email;
use App\User\Domain\Model\User\Password\PlainPassword;
use App\User\Domain\Model\User\User;
use App\User\Domain\Service\UserPasswordHasherInterface;
use App\User\Domain\Specification\UserAlreadyExistsByEmailSpecificationInterface;

class UserFactory
{
    public function __construct(
        private readonly UserPasswordHasherInterface $userPasswordHasher,
        private readonly UserAlreadyExistsByEmailSpecificationInterface $uniqueEmailSpecification
    ) {
    }

    /**
     * @throws UserAlreadyExistsException
     * @throws PasswordIsNotValidException
     * @throws EmailIsNotValidException
     */
    public function create(
        Uuid $uuid,
        Email $email,
        PlainPassword $password
    ): User {
        $user = new User($uuid, $email, $this->uniqueEmailSpecification);
        $user->setPassword($password, $this->userPasswordHasher);

        return $user;
    }
}
