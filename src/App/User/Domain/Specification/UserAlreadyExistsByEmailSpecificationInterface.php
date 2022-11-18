<?php

declare(strict_types=1);

namespace App\User\Domain\Specification;

use App\Shared\Domain\Specification\SpecificationInterface;
use App\User\Domain\Model\User\Email;

interface UserAlreadyExistsByEmailSpecificationInterface extends SpecificationInterface
{
    public function alreadyExists(Email $email): bool;
}
