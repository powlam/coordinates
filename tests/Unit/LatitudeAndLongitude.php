<?php

declare(strict_types=1);

use Powlam\Coordinates\Utils\FloatCompare;
use Powlam\Coordinates\Utils\Latitude;
use Powlam\Coordinates\Utils\Longitude;

it('can convert Latitude meters to degrees', function (): void {
    $meters = 111319.9;
    $degrees = Latitude::degreesFromMeters($meters);
    expect($degrees)->toBe(1.0);
});

it('can convert Latitude kilometers to degrees', function (): void {
    $kilometers = 111.3199;
    $degrees = Latitude::degreesFromKilometers($kilometers);
    expect($degrees)->toBe(1.0);
});

it('can return Latitude meters per degree', function (): void {
    $meters = Latitude::metersPerDegree();
    expect($meters)->toBe(111319.9);
});

it('can return Latitude kilometers per degree', function (): void {
    $kilometers = Latitude::kilometersPerDegree();
    expect($kilometers)->toBe(111.3199);
});

it('can convert Latitude degrees to meters', function (): void {
    $degrees = 1.0;
    $meters = Latitude::metersFromDegrees($degrees);
    expect($meters)->toBe(111319.9);
});

it('can convert Latitude degrees to kilometers', function (): void {
    $degrees = 1.0;
    $kilometers = Latitude::kilometersFromDegrees($degrees);
    expect($kilometers)->toBe(111.3199);
});

it('can convert Longitude meters to degrees depending on the latitude', function (): void {
    $meters = 111319.9;
    $degrees = Longitude::degreesFromMeters($meters, 0.0);
    expect($degrees)->toBe(1.0);

    $degrees = Longitude::degreesFromMeters($meters, -45.0);
    expect(round($degrees, 6))->toBe(1.414214);

    $degrees = Longitude::degreesFromMeters($meters, 90.0);
    expect($degrees)->toBe(INF);
});

it('can convert Longitude kilometers to degrees depending on the latitude', function (): void {
    $kilometers = 111.3199;
    $degrees = Longitude::degreesFromKilometers($kilometers, 0.0);
    expect($degrees)->toBe(1.0);

    $degrees = Longitude::degreesFromKilometers($kilometers, -45.0);
    expect(round($degrees, 6))->toBe(1.414214);

    $degrees = Longitude::degreesFromKilometers($kilometers, 90.0);
    expect($degrees)->toBe(INF);
});

it('can return Longitude meters per degree depending on the latitude', function (): void {
    $meters = Longitude::metersPerDegree(0.0);
    expect($meters)->toBe(111319.9);

    $meters = Longitude::metersPerDegree(-45.0);
    expect(round($meters, 6))->toBe(78715.056171);

    $meters = Longitude::metersPerDegree(90.0);
    expect(FloatCompare::equals($meters, 0.0))->toBeTrue();
});

it('can return Longitude kilometers per degree depending on the latitude', function (): void {
    $kilometers = Longitude::kilometersPerDegree(0.0);
    expect($kilometers)->toBe(111.3199);

    $kilometers = Longitude::kilometersPerDegree(-45.0);
    expect(round($kilometers, 6))->toBe(78.715056);

    $kilometers = Longitude::kilometersPerDegree(90.0);
    expect(FloatCompare::equals($kilometers, 0.0))->toBeTrue();
});

it('can convert Longitude degrees to meters depending on the latitude', function (): void {
    $degrees = 1.0;
    $meters = Longitude::metersFromDegrees($degrees, 0.0);
    expect($meters)->toBe(111319.9);

    $meters = Longitude::metersFromDegrees($degrees, -45.0);
    expect(round($meters, 6))->toBe(78715.056171);

    $meters = Longitude::metersFromDegrees($degrees, 90.0);
    expect(FloatCompare::equals($meters, 0.0))->toBeTrue();
});

it('can convert Longitude degrees to kilometers depending on the latitude', function (): void {
    $degrees = 1.0;
    $kilometers = Longitude::kilometersFromDegrees($degrees, 0.0);
    expect($kilometers)->toBe(111.3199);

    $kilometers = Longitude::kilometersFromDegrees($degrees, -45.0);
    expect(round($kilometers, 6))->toBe(78.715056);

    $kilometers = Longitude::kilometersFromDegrees($degrees, 90.0);
    expect(FloatCompare::equals($kilometers, 0.0))->toBeTrue();
});
