<?php

declare(strict_types=1);

namespace App\User\Domain\Event;

use App\Shared\Domain\Event\EventInterface;
use App\Shared\Domain\ValueObject\Uuid;

class UserCreated implements EventInterface
{
    public function __construct(
        public readonly Uuid $uuid
    ) {
    }
}

