<?php

declare(strict_types=1);

use Powlam\Coordinates\LatLng;

it('can access latitude and longitude', function (): void {
    $latLng = new LatLng(1.23, 4.56);

    expect($latLng->getLatitude())->toBe(1.23);
    expect($latLng->getLongitude())->toBe(4.56);
});

it('allows latitudes and longitudes as integers', function (): void {
    $latLng = new LatLng(1, 4);

    expect($latLng->getLatitude())->toBe(1.0);
    expect($latLng->getLongitude())->toBe(4.0);
});

it('limites latitudes out of the range -90 to 90', function (): void {
    $latLngLessThanMin = new LatLng(-100.0, 4.56);
    $latLngMoreThanMax = new LatLng(100.0, 4.56);

    expect($latLngLessThanMin->getLatitude())->toBe(-90.0);
    expect($latLngMoreThanMax->getLatitude())->toBe(90.0);
});

it('normalizes longitudes out of the range -180 to 180', function (): void {
    $latLngLessThanMin = new LatLng(1.23, -200.1);
    $latLngMoreThanMax = new LatLng(1.23, 200.1);

    expect($latLngLessThanMin->getLongitude())->toBe(159.9);
    expect($latLngMoreThanMax->getLongitude())->toBe(-159.9);
});

it('returns a string representation', function (): void {
    $latLng = new LatLng(1.23, 4.56);

    expect($latLng->__toString())->toBe('1.230000,4.560000');
});

it('returns an array', function (): void {
    $latLng = new LatLng(1.23, 4.56);

    expect($latLng->toArray())->toBe([
        'latitude' => 1.23,
        'longitude' => 4.56,
    ]);
});

it('return a URL value', function (): void {
    $latLng = new LatLng(1.23, 4.56);

    expect($latLng->toUrlValue())->toBe('1.230000,4.560000');
});

it('returs a URL value without commas if precision is 0', function (): void {
    $latLng = new LatLng(1.23, 4.56);

    expect($latLng->toUrlValue(0))->toBe('1,5');
});

it('returns a JSON representation', function (): void {
    $latLng = new LatLng(1.23, 4.56);

    expect($latLng->toJson())->toBe('{"latitude":1.23,"longitude":4.56}');
});

it('returns a GeoJSON representation', function (): void {
    $latLng = new LatLng(1.23, 4.56);

    expect($latLng->toGeoJson())->toBe('{"type":"Point","coordinates":[4.56,1.23]}');
});

it('can be created from an array', function (): void {
    $latLng = LatLng::fromArray([
        'latitude' => 1.23,
        'longitude' => 4.56,
    ]);

    expect($latLng->getLatitude())->toBe(1.23);
    expect($latLng->getLongitude())->toBe(4.56);
});
