<?php

declare(strict_types=1);

namespace App\User\Application\Fetcher;

use App\Shared\Domain\ValueObject\Uuid;
use App\User\Application\Dto\UserDto;
use App\User\Domain\Repository\UserRepositoryInterface;

class UserFetcher
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {
    }

    public function findByUuid(Uuid $uuid): ?UserDto
    {
        $user = $this->userRepository->findByUuid($uuid);

        return UserDto::createFromUser($user);
    }
}
