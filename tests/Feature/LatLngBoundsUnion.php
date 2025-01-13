<?php

declare(strict_types=1);

use Powlam\Coordinates\LatLng;
use Powlam\Coordinates\LatLngBounds;

test('union returns the original bounds if the new one is contained into it', function (): void {
    $bounds = new LatLngBounds(new LatLng(0, 1), new LatLng(10, 11));
    $union = $bounds->union(new LatLngBounds(new LatLng(2, 2), new LatLng(9, 9)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => 0.0, 'longitude' => 1.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => 11.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(-3, 160), new LatLng(10, -160));
    $union = $bounds->union(new LatLngBounds(new LatLng(2, 161), new LatLng(9, -161)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => -3.0, 'longitude' => 160.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => -160.0],
    ]);
});

test('union returns the new bounds if the original one is contained into it', function (): void {
    $bounds = new LatLngBounds(new LatLng(2, 2), new LatLng(9, 9));
    $union = $bounds->union(new LatLngBounds(new LatLng(0, 1), new LatLng(10, 11)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => 0.0, 'longitude' => 1.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => 11.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(-1, 161), new LatLng(9, -161));
    $union = $bounds->union(new LatLngBounds(new LatLng(-3, 160), new LatLng(10, -160)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => -3.0, 'longitude' => 160.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => -160.0],
    ]);
});

test('union expands the bounds towards North', function (): void {
    $bounds = new LatLngBounds(new LatLng(0, 1), new LatLng(10, 11));
    $union = $bounds->union(new LatLngBounds(new LatLng(5, 6), new LatLng(15, 9)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => 0.0, 'longitude' => 1.0],
        'northeast' => ['latitude' => 15.0, 'longitude' => 11.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(0, 1), new LatLng(10, 11));
    $union = $bounds->union(new LatLngBounds(new LatLng(15, 6), new LatLng(20, 9)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => 0.0, 'longitude' => 1.0],
        'northeast' => ['latitude' => 20.0, 'longitude' => 11.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(-20, 1), new LatLng(-10, 11));
    $union = $bounds->union(new LatLngBounds(new LatLng(-15, 6), new LatLng(-5, 9)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => -20.0, 'longitude' => 1.0],
        'northeast' => ['latitude' => -5.0, 'longitude' => 11.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(-20, 160), new LatLng(10, -160));
    $union = $bounds->union(new LatLngBounds(new LatLng(-15, 165), new LatLng(15, 175)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => -20.0, 'longitude' => 160.0],
        'northeast' => ['latitude' => 15.0, 'longitude' => -160.0],
    ]);
});

test('union expands the bounds towards South', function (): void {
    $bounds = new LatLngBounds(new LatLng(0, 1), new LatLng(10, 11));
    $union = $bounds->union(new LatLngBounds(new LatLng(-5, 6), new LatLng(5, 9)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => -5.0, 'longitude' => 1.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => 11.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(0, 1), new LatLng(10, 11));
    $union = $bounds->union(new LatLngBounds(new LatLng(-20, 6), new LatLng(-15, 9)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => -20.0, 'longitude' => 1.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => 11.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(-20, 1), new LatLng(-10, 11));
    $union = $bounds->union(new LatLngBounds(new LatLng(-25, 6), new LatLng(-15, 9)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => -25.0, 'longitude' => 1.0],
        'northeast' => ['latitude' => -10.0, 'longitude' => 11.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(-20, 160), new LatLng(10, -160));
    $union = $bounds->union(new LatLngBounds(new LatLng(-25, 165), new LatLng(-15, 175)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => -25.0, 'longitude' => 160.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => -160.0],
    ]);
});

test('union expands the bounds towards East', function (): void {
    $bounds = new LatLngBounds(new LatLng(0, 150), new LatLng(10, 170));
    $union = $bounds->union(new LatLngBounds(new LatLng(0, -160), new LatLng(10, -140)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => 0.0, 'longitude' => 150.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => -140.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(-5, 150), new LatLng(15, -170));
    $union = $bounds->union(new LatLngBounds(new LatLng(0, 160), new LatLng(10, -160)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => -5.0, 'longitude' => 150.0],
        'northeast' => ['latitude' => 15.0, 'longitude' => -160.0],
    ]);
});

test('union expands the bounds towards West', function (): void {
    $bounds = new LatLngBounds(new LatLng(0, -170), new LatLng(10, -150));
    $union = $bounds->union(new LatLngBounds(new LatLng(0, 160), new LatLng(10, 170)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => 0.0, 'longitude' => 160.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => -150.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(-5, -170), new LatLng(15, 170));
    $union = $bounds->union(new LatLngBounds(new LatLng(0, 175), new LatLng(10, -165)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => -5.0, 'longitude' => 175.0],
        'northeast' => ['latitude' => 15.0, 'longitude' => 170.0],
    ]);
});

test('union expands the bounds towards North-East', function (): void {
    $bounds = new LatLngBounds(new LatLng(0, 1), new LatLng(10, 11));
    $union = $bounds->union(new LatLngBounds(new LatLng(5, 6), new LatLng(15, 16)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => 0.0, 'longitude' => 1.0],
        'northeast' => ['latitude' => 15.0, 'longitude' => 16.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(0, 120), new LatLng(10, 171));
    $union = $bounds->union(new LatLngBounds(new LatLng(5, 160), new LatLng(15, -160)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => 0.0, 'longitude' => 120.0],
        'northeast' => ['latitude' => 15.0, 'longitude' => -160.0],
    ]);
});

test('union expands the bounds towards North-West', function (): void {
    $bounds = new LatLngBounds(new LatLng(0, 160), new LatLng(10, -160));
    $union = $bounds->union(new LatLngBounds(new LatLng(5, 150), new LatLng(15, 170)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => 0.0, 'longitude' => 150.0],
        'northeast' => ['latitude' => 15.0, 'longitude' => -160.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(0, -170), new LatLng(10, -150));
    $union = $bounds->union(new LatLngBounds(new LatLng(5, -180), new LatLng(15, -160)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => 0.0, 'longitude' => -180.0],
        'northeast' => ['latitude' => 15.0, 'longitude' => -150.0],
    ]);
});

test('union expands the bounds towards South-East', function (): void {
    $bounds = new LatLngBounds(new LatLng(0, 1), new LatLng(10, 11));
    $union = $bounds->union(new LatLngBounds(new LatLng(-5, 6), new LatLng(5, 16)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => -5.0, 'longitude' => 1.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => 16.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(-10, 120), new LatLng(10, 171));
    $union = $bounds->union(new LatLngBounds(new LatLng(-50, 160), new LatLng(5, -160)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => -50.0, 'longitude' => 120.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => -160.0],
    ]);
});

test('union expands the bounds towards South-West', function (): void {
    $bounds = new LatLngBounds(new LatLng(0, 160), new LatLng(10, -160));
    $union = $bounds->union(new LatLngBounds(new LatLng(-5, 150), new LatLng(5, 170)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => -5.0, 'longitude' => 150.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => -160.0],
    ]);

    $bounds = new LatLngBounds(new LatLng(-10, -170), new LatLng(10, -150));
    $union = $bounds->union(new LatLngBounds(new LatLng(-25, -180), new LatLng(-18, -160)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => -25.0, 'longitude' => -180.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => -150.0],
    ]);
});

test('union expands the bounds towards North-East-West', function (): void {
    $bounds = new LatLngBounds(new LatLng(0, 1), new LatLng(10, 161));
    $union = $bounds->union(new LatLngBounds(new LatLng(5, -6), new LatLng(15, -160)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => 0.0, 'longitude' => -6.0],
        'northeast' => ['latitude' => 15.0, 'longitude' => -160.0],
    ]);
});

test('union expands the bounds towards South-East-West', function (): void {
    $bounds = new LatLngBounds(new LatLng(0, 1), new LatLng(10, 161));
    $union = $bounds->union(new LatLngBounds(new LatLng(-5, -6), new LatLng(5, -160)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => -5.0, 'longitude' => -6.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => -160.0],
    ]);
});

test('union expands the bounds towards East-North-South', function (): void {
    $bounds = new LatLngBounds(new LatLng(0, 140), new LatLng(10, -170));
    $union = $bounds->union(new LatLngBounds(new LatLng(-5, 160), new LatLng(15, -160)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => -5.0, 'longitude' => 140.0],
        'northeast' => ['latitude' => 15.0, 'longitude' => -160.0],
    ]);
});

test('union expands the bounds towards West-North-South', function (): void {
    $bounds = new LatLngBounds(new LatLng(0, 140), new LatLng(10, -170));
    $union = $bounds->union(new LatLngBounds(new LatLng(-5, 115), new LatLng(15, -177)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => -5.0, 'longitude' => 115.0],
        'northeast' => ['latitude' => 15.0, 'longitude' => -170.0],
    ]);
});

test('union expands the bounds longitude all around the world', function (): void {
    $bounds = new LatLngBounds(new LatLng(-10, -15), new LatLng(10, 160));
    $union = $bounds->union(new LatLngBounds(new LatLng(0, 150), new LatLng(5, -10)));

    expect($union->toArray())->toBe([
        'southwest' => ['latitude' => -10.0, 'longitude' => -180.0],
        'northeast' => ['latitude' => 10.0, 'longitude' => 180.0],
    ]);
});
