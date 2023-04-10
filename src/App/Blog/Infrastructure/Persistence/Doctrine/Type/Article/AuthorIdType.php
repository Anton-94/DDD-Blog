<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Persistence\Doctrine\Type\Article;

use App\Blog\Domain\Model\Author\AuthorId;
use App\Shared\Infrastructure\Persistence\Doctrine\Type\UuidType;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class AuthorIdType extends UuidType
{
    public const NAME = 'author_id';

    public function convertToPHPValue($value, AbstractPlatform $platform): AuthorId
    {
        return AuthorId::from($value);
    }
}

