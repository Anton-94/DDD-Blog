<?php

declare(strict_types=1);

namespace App\Blog\Domain\Repository;

use App\Blog\Domain\Model\Article\Article;

interface ArticleRepositoryInterface
{
    public function store(Article $article): void;
}
