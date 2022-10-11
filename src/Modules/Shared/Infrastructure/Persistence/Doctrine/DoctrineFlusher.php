<?php

declare(strict_types=1);

namespace App\Modules\Shared\Infrastructure\Persistence\Doctrine;

use App\Modules\Shared\Infrastructure\Persistence\FlusherInterface;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineFlusher implements FlusherInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    public function flush(?object $entity = null): void
    {
        $this->entityManager->flush($entity);
    }
}
