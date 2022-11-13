<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Persistence\Doctrine\Type;

use App\User\Domain\Model\User\Password\HashedPassword;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class PasswordType extends StringType
{
    public const NAME = 'user_password';

    /** @param HashedPassword $value */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        return $value->value();
    }

    /** @param string $value */
    public function convertToPHPValue($value, AbstractPlatform $platform): HashedPassword
    {
        return new HashedPassword($value);
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
