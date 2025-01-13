<?php

declare(strict_types=1);

use Powlam\Coordinates\Enums\Place;
use Powlam\Coordinates\LatLng;
use Powlam\Coordinates\LatLngAltitude;
use Powlam\Coordinates\LatLngBounds;

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

it('can compare two LatLngBounds objects', function (): void {
    $latLng1 = new LatLng(1.0, 2.0);
    $latLng2 = new LatLng(3.0, 4.0);
    $latLng3 = new LatLng(5.0, 6.0);
    $latLng4 = new LatLng(7.0, 8.0);

    $latLngBounds1 = new LatLngBounds($latLng1, $latLng2);
    $latLngBounds2 = new LatLngBounds($latLng1, $latLng2);
    $latLngBounds3 = new LatLngBounds($latLng3, $latLng4);

    expect($latLngBounds1->equals($latLngBounds2))->toBeTrue();
    expect($latLngBounds1->equals($latLngBounds3))->toBeFalse();
});

it('can compare a LatLng object with a Place', function (): void {
    $latLng1 = new LatLng(1.0, 2.0);
    $latLng2 = new LatLng(90.0, 0.0);

    expect($latLng1->isPlace(Place::NORTH_POLE))->toBeFalse();
    expect($latLng2->isPlace(Place::NORTH_POLE))->toBeTrue();
    expect($latLng2->isPlace(Place::EARTH_CENTER))->toBeFalse();
    expect($latLng2->isPlace(Place::SOUTH_POLE))->toBeFalse();
    expect($latLng2->isPlace(Place::NORTHERN_HEMISPHERE))->toBeFalse();
});

it('can compare a LatLngAltitude object with a Place', function (): void {
    $latLngAltitude1 = new LatLngAltitude(1.0, 2.0, 3.0);
    $latLngAltitude2 = new LatLngAltitude(0.0, 0.0, -LatLngAltitude::EARTH_RADIUS);

    expect($latLngAltitude1->isPlace(Place::EARTH_CENTER))->toBeFalse();
    expect($latLngAltitude2->isPlace(Place::EARTH_CENTER))->toBeTrue();
    expect($latLngAltitude2->isPlace(Place::NORTH_POLE))->toBeFalse();
    expect($latLngAltitude2->isPlace(Place::NORTHERN_HEMISPHERE))->toBeFalse();
});

it('can compare a LatLngBounds object with a Place', function (): void {
    $latLngBounds1 = new LatLngBounds(new LatLng(-10.0, -10.0), new LatLng(10.0, 10.0));
    $latLngBounds2 = new LatLngBounds(new LatLng(0.0, -180.0), new LatLng(90.0, 180.0));

    expect($latLngBounds1->isPlace(Place::NORTHERN_HEMISPHERE))->toBeFalse();
    expect($latLngBounds2->isPlace(Place::NORTHERN_HEMISPHERE))->toBeTrue();
    expect($latLngBounds2->isPlace(Place::EARTH_CENTER))->toBeFalse();
    expect($latLngBounds2->isPlace(Place::NORTH_POLE))->toBeFalse();
    expect($latLngBounds2->isPlace(Place::SOUTHERN_HEMISPHERE))->toBeFalse();
});
