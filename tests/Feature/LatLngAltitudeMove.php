<?php

declare(strict_types=1);

use Powlam\Coordinates\Enums\Heading;
use Powlam\Coordinates\Enums\Units;
use Powlam\Coordinates\LatLngAltitude;

it('can move the point north', function (): void {
    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::NORTH, 1.0);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(2.23, 0.01);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(4.56, 0.01);
});

it('can move the point south', function (): void {
    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::SOUTH, 1.0);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(0.23, 0.01);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(4.56, 0.01);
});

it('can move the point east', function (): void {
    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::EAST, 1.0);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(1.23, 0.01);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(5.56, 0.01);
});

it('can move the point west', function (): void {
    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::WEST, 1.0);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(1.23, 0.01);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(3.56, 0.01);
});

it('throws an exception when moving vertically in degrees', function (): void {
    (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::UP, 1.0);
})->throws(\InvalidArgumentException::class, 'Cannot move up or down in degrees.');

it('can move the point north in (kilo)meters', function (): void {
    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::NORTH, 111319.9, Units::METERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(2.23, 0.01);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(4.56, 0.01);

    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::NORTH, 111.3199, Units::KILOMETERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(2.23, 0.01);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(4.56, 0.01);
});

it('can move the point south in (kilo)meters', function (): void {
    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::SOUTH, 111319.9, Units::METERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(0.23, 0.01);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(4.56, 0.01);

    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::SOUTH, 111.3199, Units::KILOMETERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(0.23, 0.01);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(4.56, 0.01);
});

it('can move the point east in (kilo)meters', function (): void {
    // 1 degree of longitude at the equator is 111.3199 km
    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::EAST, 111319.9, Units::METERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(1.23, 0.01);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(5.56, 0.01);

    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::EAST, 111.3199, Units::KILOMETERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(1.23, 0.01);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(5.56, 0.01);

    // 1 degree of longitude at the poles is 0 km
    $latLngAlt = (new LatLngAltitude(89.23, 4.56, 0.0))->move(Heading::EAST, 111319.9, Units::METERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(89.23, 0.01);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(78.97, 0.01);

    $latLngAlt = (new LatLngAltitude(89.23, 4.56, 0.0))->move(Heading::EAST, 111.3199, Units::KILOMETERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(89.23, 0.01);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(78.97, 0.01);
});

it('can move the point west in (kilo)meters', function (): void {
    // 1 degree of longitude at the equator is 111.3199 km
    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::WEST, 111319.9, Units::METERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(1.23, 0.01);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(3.56, 0.01);

    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::WEST, 111.3199, Units::KILOMETERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(1.23, 0.01);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(3.56, 0.01);

    // 1 degree of longitude at the poles is 0 km
    $latLngAlt = (new LatLngAltitude(89.23, 4.56, 0.0))->move(Heading::WEST, 111319.9, Units::METERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(89.23, 0.01);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(-69.85, 0.01);

    $latLngAlt = (new LatLngAltitude(89.23, 4.56, 0.0))->move(Heading::WEST, 111.3199, Units::KILOMETERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(89.23, 0.01);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(-69.85, 0.01);
});

it('can move the point up in (kilo)meters', function (): void {
    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::UP, 100.0, Units::METERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(1.23, 0.01);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(4.56, 0.01);
    expect($latLngAlt->getAltitude())->toEqualWithDelta(100.0, 0.01);

    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::UP, 0.1, Units::KILOMETERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(1.23, 0.01);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(4.56, 0.01);
    expect($latLngAlt->getAltitude())->toEqualWithDelta(100.0, 0.01);
});

it('can move the point down in (kilo)meters', function (): void {
    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::DOWN, 100.0, Units::METERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(1.23, 0.01);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(4.56, 0.01);
    expect($latLngAlt->getAltitude())->toEqualWithDelta(-100.0, 0.01);

    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::DOWN, 0.1, Units::KILOMETERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(1.23, 0.01);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(4.56, 0.01);
    expect($latLngAlt->getAltitude())->toEqualWithDelta(-100.0, 0.01);
});

it('respects the latitude limits in every movement', function (): void {
    expect((new LatLngAltitude(-90.0, 0.0, 0.0))->move(Heading::SOUTH, 1.0)->getLatitude())->toEqualWithDelta(-90.0, 0.01);
    expect((new LatLngAltitude(90.0, 0.0, 0.0))->move(Heading::NORTH, 1.0)->getLatitude())->toEqualWithDelta(90.0, 0.01);

    expect((new LatLngAltitude(-90.0, 0.0, 0.0))->move(Heading::SOUTH, 111319.9, Units::METERS)->getLatitude())->toEqualWithDelta(-90.0, 0.01);
    expect((new LatLngAltitude(90.0, 0.0, 0.0))->move(Heading::NORTH, 111319.9, Units::METERS)->getLatitude())->toEqualWithDelta(90.0, 0.01);

    expect((new LatLngAltitude(-90.0, 0.0, 0.0))->move(Heading::SOUTH, 111.3199, Units::KILOMETERS)->getLatitude())->toEqualWithDelta(-90.0, 0.01);
    expect((new LatLngAltitude(90.0, 0.0, 0.0))->move(Heading::NORTH, 111.3199, Units::KILOMETERS)->getLatitude())->toEqualWithDelta(90.0, 0.01);
});

it('respects the longitude limits in every movement', function (): void {
    expect((new LatLngAltitude(0.0, 180.0, 0.0))->move(Heading::EAST, 1.0)->getLongitude())->toEqualWithDelta(-179.0, 0.01);
    expect((new LatLngAltitude(0.0, -180.0, 0.0))->move(Heading::WEST, 1.0)->getLongitude())->toEqualWithDelta(179.0, 0.01);

    expect((new LatLngAltitude(0.0, 180.0, 0.0))->move(Heading::EAST, 111319.9, Units::METERS)->getLongitude())->toEqualWithDelta(-179.0, 0.01);
    expect((new LatLngAltitude(0.0, -180.0, 0.0))->move(Heading::WEST, 111319.9, Units::METERS)->getLongitude())->toEqualWithDelta(179.0, 0.01);

    expect((new LatLngAltitude(0.0, 180.0, 0.0))->move(Heading::EAST, 111.3199, Units::KILOMETERS)->getLongitude())->toEqualWithDelta(-179.0, 0.01);
    expect((new LatLngAltitude(0.0, -180.0, 0.0))->move(Heading::WEST, 111.3199, Units::KILOMETERS)->getLongitude())->toEqualWithDelta(179.0, 0.01);
});

it('respects the altitude limits in every movement', function (): void {
    expect((new LatLngAltitude(0.0, 0.0, -6371000.0))->move(Heading::DOWN, 100.0, Units::METERS)->getAltitude())->toEqualWithDelta(-6371000.0, 0.01);
    expect((new LatLngAltitude(0.0, 0.0, -6371000.0))->move(Heading::UP, -100.0, Units::METERS)->getAltitude())->toEqualWithDelta(-6371000.0, 0.01);
});

it('can move the point repeatedly', function (): void {
    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))
        ->move(Heading::NORTH, 10.0)
        ->move(Heading::SOUTH, 1.0)
        ->move(Heading::EAST, 20.0)
        ->move(Heading::WEST, 5.0)
        ->move(Heading::UP, 100.0, Units::METERS)
        ->move(Heading::DOWN, 30.0, Units::METERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(10.23, 0.01);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(19.56, 0.01);
    expect($latLngAlt->getAltitude())->toEqualWithDelta(70.0, 0.01);
});
