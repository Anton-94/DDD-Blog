<?php

declare(strict_types=1);

namespace App\Modules\User\Infrastructure\PasswordHasher;

use App\Modules\User\Domain\Entity\User\Password;

interface PasswordHasherInterface
{
    public function hash(string $password): Password;
}
