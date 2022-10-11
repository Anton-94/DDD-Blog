<?php

declare(strict_types=1);

namespace App\Modules\User\Infrastructure\PasswordHasher;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface as SymfonyPasswordAuthenticatedUserInterface;

interface PasswordAuthenticatedUserInterface extends SymfonyPasswordAuthenticatedUserInterface
{
}
