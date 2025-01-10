<?php

declare(strict_types=1);

use Powlam\Coordinates\LatLngAltitude;

it('can access latitude, longitude, and altitude', function (): void {
    $latLngAltitude = new LatLngAltitude(1.23, 4.56, 789.0);

    expect($latLngAltitude->getLatitude())->toBe(1.23);
    expect($latLngAltitude->getLongitude())->toBe(4.56);
    expect($latLngAltitude->getAltitude())->toBe(789.0);
});

it('allows latitudes, longitudes and altitudes as integers', function (): void {
    $latLngAltitude = new LatLngAltitude(1, 4, 789);

    expect($latLngAltitude->getLatitude())->toBe(1.0);
    expect($latLngAltitude->getLongitude())->toBe(4.0);
    expect($latLngAltitude->getAltitude())->toBe(789.0);
});

it('limits latitudes out of the range -90 to 90', function (): void {
    $latLngAltitudeLessThanMin = new LatLngAltitude(-100.0, 4.56, 789.0);
    $latLngAltitudeMoreThanMax = new LatLngAltitude(100.0, 4.56, 789.0);

    expect($latLngAltitudeLessThanMin->getLatitude())->toBe(-90.0);
    expect($latLngAltitudeMoreThanMax->getLatitude())->toBe(90.0);
});

it('normalizes longitudes out of the range -180 to 180', function (): void {
    $latLngAltitudeLessThanMin = new LatLngAltitude(1.23, -200.1, 789.0);
    $latLngAltitudeMoreThanMax = new LatLngAltitude(1.23, 200.1, 789.0);

    expect($latLngAltitudeLessThanMin->getLongitude())->toBe(159.9);
    expect($latLngAltitudeMoreThanMax->getLongitude())->toBe(-159.9);
});

it('returns a string representation', function (): void {
    $latLngAltitude = new LatLngAltitude(1.23, 4.56, 789.0);

    expect($latLngAltitude->__toString())->toBe('1.230000,4.560000,789.000000');
});

it('returns an array', function (): void {
    $latLngAltitude = new LatLngAltitude(1.23, 4.56, 789.0);

    expect($latLngAltitude->toArray())->toBe([
        'latitude' => 1.23,
        'longitude' => 4.56,
        'altitude' => 789.0,
    ]);
});

it('returns a URL value', function (): void {
    $latLngAltitude = new LatLngAltitude(1.23, 4.56, 789.0);

    expect($latLngAltitude->toUrlValue())->toBe('1.230000,4.560000,789.000000');
});

it('returns a URL value without commas if precision is 0', function (): void {
    $latLngAltitude = new LatLngAltitude(1.23, 4.56, 789.4);

    expect($latLngAltitude->toUrlValue(0))->toBe('1,5,789');
});

it('returns a JSON representation', function (): void {
    $latLngAltitude = new LatLngAltitude(1.23, 4.56, 789.0);

    expect($latLngAltitude->toJson())->toBe('{"latitude":1.23,"longitude":4.56,"altitude":789}');
});

it('returns a GeoJSON representation', function (): void {
    $latLngAltitude = new LatLngAltitude(1.23, 4.56, 789.0);

    expect($latLngAltitude->toGeoJson())->toBe('{"type":"Point","coordinates":[4.56,1.23,789]}');
});

it('returns a GeoJSON representation without altitude if it is 0', function (): void {
    $latLngAltitude = new LatLngAltitude(1.23, 4.56, 0.0);

    expect($latLngAltitude->toGeoJson())->toBe('{"type":"Point","coordinates":[4.56,1.23]}');
});

it('can be created from an array', function (): void {
    $latLngAltitude = LatLngAltitude::fromArray([
        'latitude' => 1.23,
        'longitude' => 4.56,
        'altitude' => 789.0,
    ]);

    expect($latLngAltitude->getLatitude())->toBe(1.23);
    expect($latLngAltitude->getLongitude())->toBe(4.56);
    expect($latLngAltitude->getAltitude())->toBe(789.0);
});
