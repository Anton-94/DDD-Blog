<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Article\CreateDraft;

use App\Blog\Domain\Exception\ContentCannotBeEmptyException;
use App\Blog\Domain\Exception\NameCannotBeEmptyException;
use App\Blog\Domain\Factory\ArticleFactory;
use App\Blog\Domain\Repository\ArticleRepositoryInterface;
use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\ValueObject\Uuid;

class CreateDraftCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly ArticleFactory $articleFactory,
        private readonly ArticleRepositoryInterface $articleRepository
    ) {
    }

    /**
     * @throws NameCannotBeEmptyException|ContentCannotBeEmptyException
     */
    public function __invoke(CreateDraftCommand $command): Uuid
    {
        $article = $this->articleFactory->createDraft(
            $articleId = Uuid::new(),
            $command->title,
            $command->content,
            $command->authorId
        );

        $this->articleRepository->store($article);

        /* @todo raise events */

        return $articleId;
    }
}

