<?php

declare(strict_types=1);

namespace App\Blog\Domain\Repository;

use App\Blog\Domain\Model\Article\Article;
use App\Shared\Domain\ValueObject\Uuid;

interface ArticleRepositoryInterface
{
    public function store(Article $article): void;

    public function findByUuid(Uuid $uuid): ?Article;
}
