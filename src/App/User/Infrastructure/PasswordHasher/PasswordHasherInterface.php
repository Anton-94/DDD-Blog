<?php

declare(strict_types=1);

namespace App\User\Infrastructure\PasswordHasher;

use App\User\Domain\Model\User\Password;

interface PasswordHasherInterface
{
    public function hash(string $password): Password;
}
