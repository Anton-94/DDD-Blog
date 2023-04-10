<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Article\PublishDraft;

use App\Shared\Application\Command\CommandInterface;
use App\Shared\Domain\ValueObject\Uuid;

class PublishDraftCommand implements CommandInterface
{
    public function __construct(
        public readonly Uuid $authorId,
        public readonly Uuid $articleId,
    ) {
    }
}

