<?php

/** @noinspection StaticClosureCanBeUsedInspection */

declare(strict_types=1);

use Tests\Fakes\Enums\StringBackedEnum;

test('find by name and value', function (): void {
    expect(StringBackedEnum::find('Published'))
        ->toBe(StringBackedEnum::Published)
        ->and(StringBackedEnum::find('draft'))
        ->toBe(StringBackedEnum::Draft);

    $this->expectException(ValueError::class);
    $this->expectExceptionMessage('"invalid" is not a valid backing value for enum StringBackedEnum');

    StringBackedEnum::find('invalid');
});

test('try find by name and value', function (): void {
    expect(StringBackedEnum::tryFind('Published'))
        ->toBe(StringBackedEnum::Published)
        ->and(StringBackedEnum::tryFind('draft'))
        ->toBe(StringBackedEnum::Draft)
        ->and(StringBackedEnum::tryFind('invalid'))
        ->toBeNull();
});

test('array names', function (): void {
    expect(StringBackedEnum::getNames())
        ->toBe(['Published', 'Draft']);
});

test('array values', function (): void {
    expect(StringBackedEnum::getValues())
        ->toBe(['published', 'draft']);
});

test('to array', function (): void {
    expect(StringBackedEnum::toArray())
        ->toBe(['Published' => 'published', 'Draft' => 'draft']);
});
