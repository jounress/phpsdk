<?php

declare(strict_types=1);

namespace Jounress\PhpSdk\Traits;

use UnitEnum;
use ValueError;

/**
 * @phpstan-require-implements UnitEnum
 */
trait HandlesEnums
{
    /**
     * Find an enum by name or value.
     */
    public static function find(int|string $value): self
    {
        return self::tryFind($value)
            ?? throw new ValueError(sprintf(
                '"%s" is not a valid value for enum %s',
                $value,
                basename(str_replace('\\', '/', self::class))
            ));
    }

    /**
     * Find an enum by name or value.
     */
    public static function tryFind(int|string $value): ?self
    {
        if (in_array($value, self::names(), true)) {
            return constant("self::{$value}"); // @phpstan-ignore-line
        }

        if (in_array($value, self::values(), true)) {
            return self::tryFrom($value);
        }

        return null;
    }

    /**
     * Get all enum names.
     *
     * @return array<string>
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * Get all enum values.
     *
     * @return array<int|string>
     */
    public static function values(): array
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
        return array_combine(self::names(), self::values());
    }
}
