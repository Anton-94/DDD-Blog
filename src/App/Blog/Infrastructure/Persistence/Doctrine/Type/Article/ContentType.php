<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Persistence\Doctrine\Type\Article;

use App\Blog\Domain\Model\Article\Content;
use App\Blog\Infrastructure\Service\Content\Sanitize\NotSanitizeContent;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\TextType;

class ContentType extends TextType
{
    public const NAME = 'article_content';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->value();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): Content
    {
        return new Content($value, new NotSanitizeContent());
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
