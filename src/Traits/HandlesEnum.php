<?php

declare(strict_types=1);

namespace Jounress\PhpSdk\Traits;

use BackedEnum;
use ValueError;

/**
 * @mixin BackedEnum
 */
trait HandlesEnum
{
    /**
     * Find an enum by name or value.
     */
    public static function find(int|string $value): self
    {
        return self::tryFind($value)
            ?? throw new ValueError(sprintf(
                '"%s" is not a valid backing value for enum %s',
                $value,
                basename(str_replace('\\', '/', self::class))
            ));
    }

    /**
     * Find an enum by name or value.
     */
    public static function tryFind(int|string $value): ?self
    {
        if (in_array($value, self::getNames(), true)) {
            return constant("self::{$value}"); // @phpstan-ignore-line
        }

        if (in_array($value, self::getValues(), true)) {
            return self::tryFrom($value);
        }

        return null;
    }

    /**
     * Get all enum names.
     *
     * @return array<string>
     */
    public static function getNames(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * Get all enum values.
     *
     * @return array<int|string>
     */
    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get all enum values as an associative array.
     *
     * @return array<string, int|string>
     */
    public static function toArray(): array
    {
        return array_combine(self::getNames(), self::getValues());
    }
}
