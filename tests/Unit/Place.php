<?php

declare(strict_types=1);

use Powlam\Coordinates\Enums\Place;
use Powlam\Coordinates\LatLng;
use Powlam\Coordinates\LatLngAltitude;

it('knows the North Pole', function (): void {
    $northPole = Place::NORTH_POLE->get();

    expect($northPole)->toBeInstanceOf(LatLng::class);
    expect($northPole->getLatitude())->toEqual(90.0);
    expect(Place::NORTH_POLE->name())->toEqual('North Pole');
});

it('knows the South Pole', function (): void {
    $southPole = Place::SOUTH_POLE->get();

    expect($southPole)->toBeInstanceOf(LatLng::class);
    expect($southPole->getLatitude())->toEqual(-90.0);
    expect(Place::SOUTH_POLE->name())->toEqual('South Pole');
});

it('knows the Earth Center', function (): void {
    $earthCenter = Place::EARTH_CENTER->get();

    expect($earthCenter)->toBeInstanceOf(LatLngAltitude::class);
    expect($earthCenter->getAltitude())->toEqual(-LatLngAltitude::EARTH_RADIUS);
    expect(Place::EARTH_CENTER->name())->toEqual('Earth Center');
});
