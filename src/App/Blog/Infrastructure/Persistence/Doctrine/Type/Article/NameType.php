<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Persistence\Doctrine\Type\Article;

use App\Blog\Domain\Model\Article\Title;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class NameType extends StringType
{
    public const NAME = 'article_name';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->value();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): Title
    {
        return new Title($value);
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
