<?php

declare(strict_types=1);

namespace App\User\Infrastructure\PasswordHasher;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface as SymfonyPasswordAuthenticatedUserInterface;

interface PasswordAuthenticatedUserInterface extends SymfonyPasswordAuthenticatedUserInterface
{
}
