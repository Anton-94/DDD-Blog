<?php

declare(strict_types=1);

namespace App\Shared\Domain\Model;

use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\ORM\Mapping as ORM;

trait UuidTrait
{
    #[ORM\Column(type: 'uuid')]
    protected Uuid $uuid;

    public function uuid(): Uuid
    {
        return $this->uuid;
    }
}
