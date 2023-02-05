<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Repository\Article;

use App\Blog\Domain\Model\Article\Article;
use App\Blog\Domain\Repository\ArticleRepositoryInterface;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ArticleRepository extends ServiceEntityRepository implements ArticleRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function store(Article $article): void
    {
        $this->getEntityManager()->persist($article);
        $this->getEntityManager()->flush();
    }

    public function findByUuid(Uuid $uuid): ?Article
    {
        return $this->findOneBy(['uuid' => $uuid]);
    }
}

