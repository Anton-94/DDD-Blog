<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Article\CreateDraft;

use App\Blog\Domain\Exception\ContentCannotBeEmptyException;
use App\Blog\Domain\Exception\NameCannotBeEmptyException;
use App\Blog\Domain\Factory\ArticleFactory;
use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\ValueObject\Uuid;

class CreateDraftCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly ArticleFactory $articleFactory
    ) {
    }

    /**
     * @throws NameCannotBeEmptyException|ContentCannotBeEmptyException
     */
    public function __invoke(CreateDraftCommand $command): Uuid
    {
        $this->articleFactory->createDraft(
            $articleId = Uuid::new(),
            $command->name,
            $command->content,
            $command->authorId
        );

        /* @todo raise events */

        return $articleId;
    }
}

