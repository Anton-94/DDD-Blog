<?php

declare(strict_types=1);

namespace App\User\Domain\Repository;

use App\Shared\Domain\ValueObject\Uuid;
use App\User\Domain\Model\User\Email;
use App\User\Domain\Model\User\User;

interface UserRepositoryInterface
{
    public function store(User $user): void;

    public function findByEmail(Email $email): ?User;

    public function findByUuid(Uuid $uuid): ?User;
}
