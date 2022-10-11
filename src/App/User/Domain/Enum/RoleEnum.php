<?php

namespace App\User\Domain\Enum;

enum RoleEnum: string
{
    case ROLE_USER = 'ROLE_USER';
    case ROLE_ADMIN = 'ROLE_ADMIN';
}
