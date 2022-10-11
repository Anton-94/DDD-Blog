<?php

declare(strict_types=1);

namespace App\Modules\Shared\Infrastructure\Persistence\Doctrine\Type;

use App\Modules\Shared\Infrastructure\Exception\InfrastructureException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use ReflectionEnum;
use ReflectionException;

abstract class AbstractEnumType extends Type
{
    /** @throws ReflectionException */
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return BackedEnum::INT === $this->detectEnumType()
            ? $platform->getIntegerTypeDeclarationSQL($column)
            : $platform->getStringTypeDeclarationSQL($column);
    }

    abstract public function getName(): string;

    abstract public function getEnumClassname(): string;

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform)
    {
        return $value?->value;
    }

    /**
     * @throws ReflectionException
     * @throws InfrastructureException
     */
    public function convertToPHPValue(mixed $value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        $value = $this->detectEnumType()->cast($value);
        $class = $this->getEnumClassname();

        if (!class_exists($class)) {
            throw InfrastructureException::create(__METHOD__, 'Enum does not exists.', ['enum' => $class]);
        }

        return $class::from($value);
    }

    /** @throws ReflectionException */
    private function detectEnumType(): BackedEnum
    {
        $type = (new ReflectionEnum($this->getEnumClassname()))->getBackingType()?->getName();

        return 'int' === $type ? BackedEnum::INT : BackedEnum::STRING;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
