<?php

declare(strict_types=1);

namespace App\Shared\Domain\Model;

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
