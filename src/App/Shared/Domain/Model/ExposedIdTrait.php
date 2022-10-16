<?php

declare(strict_types=1);

namespace App\Shared\Domain\Model;

use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\ORM\Mapping as ORM;

trait ExposedIdTrait
{
    #[ORM\Column(type: 'uuid')]
    protected Uuid $exposedId;

    public function exposedId(): Uuid
    {
        return $this->exposedId;
    }
}
