<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Article\PublishDraft;

use App\Blog\Application\Exception\Article\ArticleNotFoundException;
use App\Blog\Domain\Model\Author\AuthorId;
use App\Blog\Domain\Repository\ArticleRepositoryInterface;
use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\ValueObject\Uuid;

class PublishDraftCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly ArticleRepositoryInterface $articleRepository,
    ) {
    }

    /**
     * @throws ArticleNotFoundException
     */
    public function __invoke(PublishDraftCommand $command): Uuid
    {
        $article = $this->articleRepository->findByUuidAndAuthor($command->articleId, AuthorId::from($command->authorId))
            ?? throw new ArticleNotFoundException();

        $article->publish();

        $this->articleRepository->save($article);

        return $article->uuid();
    }
}

