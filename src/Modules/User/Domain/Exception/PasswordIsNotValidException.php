<?php

declare(strict_types=1);

namespace App\Modules\User\Domain\Exception;

use App\Modules\Shared\Domain\Exception\DomainException;

class PasswordIsNotValidException extends DomainException
{
}