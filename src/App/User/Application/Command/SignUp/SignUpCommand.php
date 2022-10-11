<?php

declare(strict_types=1);

namespace App\User\Application\Command\SignUp;

use App\Shared\Application\Command\CommandInterface;

final class SignUpCommand implements CommandInterface
{
    public function __construct(
        public readonly string $email,
        public readonly string $password
    ) {
    }
}
