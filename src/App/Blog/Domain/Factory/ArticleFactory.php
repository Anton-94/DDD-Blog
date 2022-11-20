<?php

declare(strict_types=1);

namespace App\Blog\Domain\Factory;

use App\Blog\Domain\Exception\ContentCannotBeEmptyException;
use App\Blog\Domain\Exception\NameCannotBeEmptyException;
use App\Blog\Domain\Model\Article\Article;
use App\Blog\Domain\Model\Article\Content;
use App\Blog\Domain\Model\Article\Name;
use App\Blog\Domain\Model\Author\AuthorId;
use App\Blog\Domain\Service\SanitizeContentInterface;
use App\Shared\Domain\ValueObject\Uuid;

class ArticleFactory
{
    public function __construct(
        private readonly SanitizeContentInterface $sanitizeContent
    ) {
    }

    /**
     * @throws NameCannotBeEmptyException|ContentCannotBeEmptyException
     */
    public function createDraft(Uuid $uuid, string $name, string $content, AuthorId $authorId): Article
    {
        return new Article(
            $uuid,
            new Name($name),
            new Content($content, $this->sanitizeContent),
            $authorId
        );
    }
}
