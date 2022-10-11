<?php

declare(strict_types=1);

namespace App\Modules\Shared\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

trait IdTrait
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer', nullable: false)]
    protected int $id;

    public function id(): int
    {
        return $this->id;
    }
}
