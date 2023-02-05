<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Article\CreateDraft;

use App\Blog\Domain\Model\Author\AuthorId;
use App\Shared\Application\Command\CommandInterface;

class CreateDraftCommand implements CommandInterface
{
    public function __construct(
        public readonly string $title,
        public readonly string $content,
        public readonly AuthorId $authorId /* @todo push author here or in command handler */
    ) {
    }
}
