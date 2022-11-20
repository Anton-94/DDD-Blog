<?php

declare(strict_types=1);

namespace App\Blog\Domain\Model\Article;

use App\Blog\Domain\Enum\Article\StatusEnum;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Status
{
    #[ORM\Column(type: 'string', enumType: StatusEnum::class)]
    private StatusEnum $type;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private DateTimeInterface $updateDate;

    public function __construct(StatusEnum $type, DateTimeInterface $updateDate)
    {
        $this->type = $type;
        $this->updateDate = $updateDate;
    }

    public function type(): StatusEnum
    {
        return $this->type;
    }

    public function updateDate(): DateTimeInterface
    {
        return $this->updateDate;
    }
}

