<?php

declare(strict_types=1);

use Powlam\Coordinates\Utils\FloatCompare;

it('identifies that two floats are equal', function (): void {
    expect(FloatCompare::equals(1.0, 1.0))->toBeTrue();
    expect(FloatCompare::equals(1.0, 1.000001))->toBeTrue();
    expect(FloatCompare::equals(1.0, 1.00001))->toBeFalse();
});

it('identifies that one float is equal or greater than another', function (): void {
    expect(FloatCompare::equalOrGreaterThan(1.0, 0.999999))->toBeTrue();
    expect(FloatCompare::equalOrGreaterThan(1.0, 1.0))->toBeTrue();
    expect(FloatCompare::equalOrGreaterThan(1.0, 1.000001))->toBeTrue();
    expect(FloatCompare::equalOrGreaterThan(1.0, 1.00001))->toBeFalse();
});

it('identifies that one float is equal or less than another', function (): void {
    expect(FloatCompare::equalOrLessThan(1.0, 1.000001))->toBeTrue();
    expect(FloatCompare::equalOrLessThan(1.0, 1.0))->toBeTrue();
    expect(FloatCompare::equalOrLessThan(1.0, 0.9999999))->toBeTrue();
    expect(FloatCompare::equalOrLessThan(1.0, 0.999999))->toBeFalse();
});

it('identifies that one float is greater than another', function (): void {
    expect(FloatCompare::greaterThan(1.0, 1.00001))->toBeFalse();
    expect(FloatCompare::greaterThan(1.0, 1.0))->toBeFalse();
    expect(FloatCompare::greaterThan(1.0, 0.9999999))->toBeFalse();
    expect(FloatCompare::greaterThan(1.0, 0.999999))->toBeTrue();
});

it('identifies that one float is less than another', function (): void {
    expect(FloatCompare::lessThan(1.0, 0.999999))->toBeFalse();
    expect(FloatCompare::lessThan(1.0, 1.0))->toBeFalse();
    expect(FloatCompare::lessThan(1.0, 1.000001))->toBeFalse();
    expect(FloatCompare::lessThan(1.0, 1.00001))->toBeTrue();
});
