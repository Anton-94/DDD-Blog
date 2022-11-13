<?php

declare(strict_types=1);

namespace App\User\Domain\Service;

use App\User\Domain\Model\User\Password\HashedPassword;
use App\User\Domain\Model\User\Password\PlainPassword;
use App\User\Domain\Model\User\User;

interface UserPasswordHasherInterface
{
    public function hash(PlainPassword $password, User $user): HashedPassword;
}
