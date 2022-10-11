<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence;

interface FlusherInterface
{
    public function flush(?object $entity = null): void;
}
