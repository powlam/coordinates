<?php

declare(strict_types=1);

use Powlam\Coordinates\LatLng;
use Powlam\Coordinates\LatLngBounds;

test('extend does not change the bounds if the point is already included', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 2), new LatLng(10, 11));
    $bounds->extend(new LatLng(5, 6));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => 1.0, 'longitude' => 2.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => 11.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(-1, 160), new LatLng(10, -111));
    $bounds->extend(new LatLng(5, 165));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => -1.0, 'longitude' => 160.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => -111.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(-1, 160), new LatLng(10, -111));
    $bounds->extend(new LatLng(-1, -165));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => -1.0, 'longitude' => 160.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => -111.0],
    ]);
});

test('extend expands the bounds towards North', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, -2), new LatLng(10, 11));
    $bounds->extend(new LatLng(15, 6));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => 1.0, 'longitude' => -2.0],
        'northeast' => ['latitude' => 15.0, 'longitude' => 11.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(-21, 165), new LatLng(-10, -111));
    $bounds->extend(new LatLng(-5, 176));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => -21.0, 'longitude' => 165.0],
        'northeast' => ['latitude' => -5.0, 'longitude' => -111.0],
    ]);
});

test('extend expands the bounds towards South', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, -2), new LatLng(10, 11));
    $bounds->extend(new LatLng(-5, 6));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => -5.0, 'longitude' => -2.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => 11.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(-21, 165), new LatLng(-10, -111));
    $bounds->extend(new LatLng(-25, 176));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => -25.0, 'longitude' => 165.0],
        'northeast' => ['latitude' => -10.0, 'longitude' => -111.0],
    ]);
});

test('extend expands the bounds towards East', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 1), new LatLng(10, 60));
    $bounds->extend(new LatLng(5, 150));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => 1.0, 'longitude' => 1.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => 150.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(-10, 1), new LatLng(10, -160));
    $bounds->extend(new LatLng(5, -150));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => -10.0, 'longitude' => 1.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => -150.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(0, 170), new LatLng(10, -2));
    $bounds->extend(new LatLng(5, 2));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => 0.0, 'longitude' => 170.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => 2.0],
    ]);
});

test('extend expands the bounds towards West', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 15), new LatLng(10, 60));
    $bounds->extend(new LatLng(5, 10));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => 1.0, 'longitude' => 10.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => 60.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(0, 160), new LatLng(10, -160));
    $bounds->extend(new LatLng(5, 150));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => 0.0, 'longitude' => 150.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => -160.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(0, 1), new LatLng(10, -160));
    $bounds->extend(new LatLng(5, -2));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => 0.0, 'longitude' => -2.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => -160.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(0, 170), new LatLng(10, -2));
    $bounds->extend(new LatLng(5, 165));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => 0.0, 'longitude' => 165.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => -2.0],
    ]);
});

test('extend expands the bounds towards North-East', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 2), new LatLng(10, 11));
    $bounds->extend(new LatLng(15, 16));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => 1.0, 'longitude' => 2.0],
        'northeast' => ['latitude' => 15.0, 'longitude' => 16.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(1, 160), new LatLng(10, -160));
    $bounds->extend(new LatLng(15, -150));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => 1.0, 'longitude' => 160.0],
        'northeast' => ['latitude' => 15.0, 'longitude' => -150.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(1, 2), new LatLng(10, 170));
    $bounds->extend(new LatLng(15, -160));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => 1.0, 'longitude' => 2.0],
        'northeast' => ['latitude' => 15.0, 'longitude' => -160.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(1, 160), new LatLng(10, -10));
    $bounds->extend(new LatLng(15, 10));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => 1.0, 'longitude' => 160.0],
        'northeast' => ['latitude' => 15.0, 'longitude' => 10.0],
    ]);
});

test('extend expands the bounds towards North-West', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 20), new LatLng(10, 110));
    $bounds->extend(new LatLng(15, 15));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => 1.0, 'longitude' => 15.0],
        'northeast' => ['latitude' => 15.0, 'longitude' => 110.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(1, 160), new LatLng(10, -160));
    $bounds->extend(new LatLng(15, 150));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => 1.0, 'longitude' => 150.0],
        'northeast' => ['latitude' => 15.0, 'longitude' => -160.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(1, 2), new LatLng(10, 11));
    $bounds->extend(new LatLng(15, -6));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => 1.0, 'longitude' => -6.0],
        'northeast' => ['latitude' => 15.0, 'longitude' => 11.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(1, 10), new LatLng(10, -160));
    $bounds->extend(new LatLng(15, -10));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => 1.0, 'longitude' => -10.0],
        'northeast' => ['latitude' => 15.0, 'longitude' => -160.0],
    ]);
});

test('extend expands the bounds towards South-East', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 2), new LatLng(10, 11));
    $bounds->extend(new LatLng(-5, 16));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => -5.0, 'longitude' => 2.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => 16.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(1, 160), new LatLng(10, -10));
    $bounds->extend(new LatLng(-5, 5));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => -5.0, 'longitude' => 160.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => 5.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(1, 2), new LatLng(10, 11));
    $bounds->extend(new LatLng(-15, -6));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => -15.0, 'longitude' => -6.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => 11.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(1, 160), new LatLng(10, -160));
    $bounds->extend(new LatLng(-15, -150));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => -15.0, 'longitude' => 160.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => -150.0],
    ]);
});

test('extend expands the bounds towards South-West', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 2), new LatLng(10, 11));
    $bounds->extend(new LatLng(-15, 1));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => -15.0, 'longitude' => 1.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => 11.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(1, 160), new LatLng(10, -160));
    $bounds->extend(new LatLng(-15, 150));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => -15.0, 'longitude' => 150.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => -160.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(1, 2), new LatLng(10, 11));
    $bounds->extend(new LatLng(0, -6));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => 0.0, 'longitude' => -6.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => 11.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(1, 6), new LatLng(10, -160));
    $bounds->extend(new LatLng(-5, -10));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => -5.0, 'longitude' => -10.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => -160.0],
    ]);
});

test('extend expands the bounds towards East if there is the same distance towards West and East', function (): void {
    $bounds = new LatLngBounds(new LatLng(0, 0), new LatLng(10, 160));
    $bounds->extend(new LatLng(5, -100));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => 0.0, 'longitude' => 0.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => -100.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(0, -160), new LatLng(10, 0));
    $bounds->extend(new LatLng(5, 100));

    expect($bounds->toArray())->toBe([
        'southwest' => ['latitude' => 0.0, 'longitude' => -160.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => 100.0],
    ]);
});
