<?php

declare(strict_types=1);

use Powlam\Coordinates\Enums\Place;
use Powlam\Coordinates\LatLng;
use Powlam\Coordinates\LatLngAltitude;

it('can compare two LatLng objects', function (): void {
    $latLng1 = new LatLng(1.0, 2.0);
    $latLng2 = new LatLng(1.0, 2.0);
    $latLng3 = new LatLng(1.0, 3.0);

    expect($latLng1->equals($latLng2))->toBeTrue();
    expect($latLng1->equals($latLng3))->toBeFalse();
});

it('can compare two LatLngAltitude objects', function (): void {
    $latLngAltitude1 = new LatLngAltitude(1.0, 2.0, 3.0);
    $latLngAltitude2 = new LatLngAltitude(1.0, 2.0, 3.0);
    $latLngAltitude3 = new LatLngAltitude(1.0, 2.0, 4.0);

    expect($latLngAltitude1->equals($latLngAltitude2))->toBeTrue();
    expect($latLngAltitude1->equals($latLngAltitude3))->toBeFalse();
});

it('can compare a LatLng object with a Place', function (): void {
    $latLng1 = new LatLng(1.0, 2.0);
    $latLng2 = new LatLng(90.0, 0.0);

    expect($latLng1->isPlace(Place::NORTH_POLE))->toBeFalse();
    expect($latLng2->isPlace(Place::NORTH_POLE))->toBeTrue();
    expect($latLng2->isPlace(Place::EARTH_CENTER))->toBeFalse();
});

it('can compare a LatLngAltitude object with a Place', function (): void {
    $latLngAltitude1 = new LatLngAltitude(1.0, 2.0, 3.0);
    $latLngAltitude2 = new LatLngAltitude(0.0, 0.0, -LatLngAltitude::EARTH_RADIUS);

    expect($latLngAltitude1->isPlace(Place::EARTH_CENTER))->toBeFalse();
    expect($latLngAltitude2->isPlace(Place::EARTH_CENTER))->toBeTrue();
    expect($latLngAltitude2->isPlace(Place::NORTH_POLE))->toBeFalse();
});
