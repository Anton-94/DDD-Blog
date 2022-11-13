<?php

declare(strict_types=1);

namespace App\User\Application\Dto;

use App\Shared\Domain\ValueObject\Uuid;
use App\User\Domain\Model\User\Email;
use App\User\Domain\Model\User\User;

class UserDto
{
    public function __construct(
        public readonly Uuid $uuid,
        public readonly Email $email,
        public readonly array $roles
    ) {
    }

    public static function createFromUser(User $user): self
    {
        return new self($user->uuid(), $user->email(), $user->roles());
    }
}
