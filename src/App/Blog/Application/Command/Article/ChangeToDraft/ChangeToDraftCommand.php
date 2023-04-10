<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Article\ChangeToDraft;

use App\Shared\Application\Command\CommandInterface;
use App\Shared\Domain\ValueObject\Uuid;

class ChangeToDraftCommand implements CommandInterface
{
    public function __construct(
        public readonly Uuid $authorId,
        public readonly Uuid $articleId,
    ) {
    }
}

