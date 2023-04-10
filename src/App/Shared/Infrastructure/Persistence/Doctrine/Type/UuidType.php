<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Type;

use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class UuidType extends StringType
{
    public const NAME = 'uuid';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->value();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): Uuid
    {
        return new Uuid($value);
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getStringTypeDeclarationSQL(['length' => 36]);
    }

    protected static function className(): string
    {
        return Uuid::class;
    }

    public function getName(): string
    {
        return static::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
