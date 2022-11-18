<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Specification;

use App\User\Domain\Model\User\Email;
use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Domain\Specification\UserAlreadyExistsByEmailSpecificationInterface;

class UserAlreadyExistsByEmailSpecification implements UserAlreadyExistsByEmailSpecificationInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {
    }

    public function alreadyExists(Email $email): bool
    {
        return $this->isSatisfiedBy($email);
    }

    /** @param Email $value */
    public function isSatisfiedBy(mixed $value): bool
    {
        return (bool) $this->userRepository->findByEmail($value);
    }
}
