<?php

declare(strict_types=1);

namespace UI\Http\Rest\Input\User;

use Symfony\Component\Validator\Constraints as Assert;
use UI\Http\Rest\Input\Shared\InputInterface;

class SignUpInput implements InputInterface
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly string $email,
        #[Assert\NotBlank]
        public readonly string $password,
    ) {
    }
}

