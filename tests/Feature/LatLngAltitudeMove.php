<?php

declare(strict_types=1);

use Powlam\Coordinates\Enums\Heading;
use Powlam\Coordinates\Enums\Units;
use Powlam\Coordinates\LatLngAltitude;
use Powlam\Coordinates\Utils\FloatCompare;
use Powlam\Coordinates\Utils\Latitude;
use Powlam\Coordinates\Utils\Longitude;

it('can move the point north', function (): void {
    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::NORTH, 1.0);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(2.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(4.56, FloatCompare::COMPARISON_TOLERANCE);
});

it('can move the point south', function (): void {
    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::SOUTH, 1.0);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(0.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(4.56, FloatCompare::COMPARISON_TOLERANCE);
});

it('can move the point east', function (): void {
    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::EAST, 1.0);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(1.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(5.56, FloatCompare::COMPARISON_TOLERANCE);
});

it('can move the point west', function (): void {
    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::WEST, 1.0);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(1.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(3.56, FloatCompare::COMPARISON_TOLERANCE);
});

it('throws an exception when moving vertically in degrees', function (): void {
    (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::UP, 1.0);
})->throws(\InvalidArgumentException::class, 'Cannot move up or down in degrees.');

it('can move the point north in (kilo)meters', function (): void {
    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::NORTH, Latitude::METERS_PER_DEGREE, Units::METERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(2.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(4.56, FloatCompare::COMPARISON_TOLERANCE);

    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::NORTH, Latitude::KILOMETERS_PER_DEGREE, Units::KILOMETERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(2.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(4.56, FloatCompare::COMPARISON_TOLERANCE);
});

it('can move the point south in (kilo)meters', function (): void {
    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::SOUTH, Latitude::METERS_PER_DEGREE, Units::METERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(0.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(4.56, FloatCompare::COMPARISON_TOLERANCE);

    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::SOUTH, Latitude::KILOMETERS_PER_DEGREE, Units::KILOMETERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(0.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(4.56, FloatCompare::COMPARISON_TOLERANCE);
});

it('can move the point east in (kilo)meters', function (): void {
    $latLngAlt = (new LatLngAltitude(31.23, 4.56, 0.0))->move(Heading::EAST, Longitude::metersFromDegrees(1.0, 31.23), Units::METERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(31.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(5.56, FloatCompare::COMPARISON_TOLERANCE);

    $latLngAlt = (new LatLngAltitude(31.23, 4.56, 0.0))->move(Heading::EAST, Longitude::kilometersFromDegrees(1.0, 31.23), Units::KILOMETERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(31.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(5.56, FloatCompare::COMPARISON_TOLERANCE);

    $latLngAlt = (new LatLngAltitude(0.00, 4.56, 0.0))->move(Heading::EAST, Longitude::metersFromDegrees(1.0, 0.0), Units::METERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(0.00, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(5.56, FloatCompare::COMPARISON_TOLERANCE);

    $latLngAlt = (new LatLngAltitude(0.00, 4.56, 0.0))->move(Heading::EAST, Longitude::kilometersFromDegrees(1.0, 0.0), Units::KILOMETERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(0.00, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(5.56, FloatCompare::COMPARISON_TOLERANCE);
});

it('can move the point west in (kilo)meters', function (): void {
    $latLngAlt = (new LatLngAltitude(31.23, 4.56, 0.0))->move(Heading::WEST, Longitude::metersFromDegrees(1.0, 31.23), Units::METERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(31.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(3.56, FloatCompare::COMPARISON_TOLERANCE);

    $latLngAlt = (new LatLngAltitude(31.23, 4.56, 0.0))->move(Heading::WEST, Longitude::kilometersFromDegrees(1.0, 31.23), Units::KILOMETERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(31.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(3.56, FloatCompare::COMPARISON_TOLERANCE);

    $latLngAlt = (new LatLngAltitude(0.00, 4.56, 0.0))->move(Heading::WEST, Longitude::metersFromDegrees(1.0, 0.0), Units::METERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(0.00, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(3.56, FloatCompare::COMPARISON_TOLERANCE);

    $latLngAlt = (new LatLngAltitude(0.00, 4.56, 0.0))->move(Heading::WEST, Longitude::kilometersFromDegrees(1.0, 0.0), Units::KILOMETERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(0.00, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(3.56, FloatCompare::COMPARISON_TOLERANCE);
});

it('can move the point up in (kilo)meters', function (): void {
    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::UP, 100.0, Units::METERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(1.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(4.56, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngAlt->getAltitude())->toEqualWithDelta(100.0, FloatCompare::COMPARISON_TOLERANCE);

    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::UP, 0.1, Units::KILOMETERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(1.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(4.56, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngAlt->getAltitude())->toEqualWithDelta(100.0, FloatCompare::COMPARISON_TOLERANCE);
});

it('can move the point down in (kilo)meters', function (): void {
    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::DOWN, 100.0, Units::METERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(1.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(4.56, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngAlt->getAltitude())->toEqualWithDelta(-100.0, FloatCompare::COMPARISON_TOLERANCE);

    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))->move(Heading::DOWN, 0.1, Units::KILOMETERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(1.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(4.56, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngAlt->getAltitude())->toEqualWithDelta(-100.0, FloatCompare::COMPARISON_TOLERANCE);
});

it('respects the latitude limits in every movement', function (): void {
    expect((new LatLngAltitude(-90.0, 0.0, 0.0))->move(Heading::SOUTH, 1.0)->getLatitude())->toEqualWithDelta(-90.0, FloatCompare::COMPARISON_TOLERANCE);
    expect((new LatLngAltitude(90.0, 0.0, 0.0))->move(Heading::NORTH, 1.0)->getLatitude())->toEqualWithDelta(90.0, FloatCompare::COMPARISON_TOLERANCE);

    expect((new LatLngAltitude(-90.0, 0.0, 0.0))->move(Heading::SOUTH, Latitude::METERS_PER_DEGREE, Units::METERS)->getLatitude())->toEqualWithDelta(-90.0, FloatCompare::COMPARISON_TOLERANCE);
    expect((new LatLngAltitude(90.0, 0.0, 0.0))->move(Heading::NORTH, Latitude::METERS_PER_DEGREE, Units::METERS)->getLatitude())->toEqualWithDelta(90.0, FloatCompare::COMPARISON_TOLERANCE);

    expect((new LatLngAltitude(-90.0, 0.0, 0.0))->move(Heading::SOUTH, Latitude::KILOMETERS_PER_DEGREE, Units::KILOMETERS)->getLatitude())->toEqualWithDelta(-90.0, FloatCompare::COMPARISON_TOLERANCE);
    expect((new LatLngAltitude(90.0, 0.0, 0.0))->move(Heading::NORTH, Latitude::KILOMETERS_PER_DEGREE, Units::KILOMETERS)->getLatitude())->toEqualWithDelta(90.0, FloatCompare::COMPARISON_TOLERANCE);
});

it('respects the longitude limits in every movement', function (): void {
    expect((new LatLngAltitude(0.0, 180.0, 0.0))->move(Heading::EAST, 1.0)->getLongitude())->toEqualWithDelta(-179.0, FloatCompare::COMPARISON_TOLERANCE);
    expect((new LatLngAltitude(0.0, -180.0, 0.0))->move(Heading::WEST, 1.0)->getLongitude())->toEqualWithDelta(179.0, FloatCompare::COMPARISON_TOLERANCE);

    expect((new LatLngAltitude(0.0, 180.0, 0.0))->move(Heading::EAST, Latitude::METERS_PER_DEGREE, Units::METERS)->getLongitude())->toEqualWithDelta(-179.0, FloatCompare::COMPARISON_TOLERANCE);
    expect((new LatLngAltitude(0.0, -180.0, 0.0))->move(Heading::WEST, Latitude::METERS_PER_DEGREE, Units::METERS)->getLongitude())->toEqualWithDelta(179.0, FloatCompare::COMPARISON_TOLERANCE);

    expect((new LatLngAltitude(0.0, 180.0, 0.0))->move(Heading::EAST, Latitude::KILOMETERS_PER_DEGREE, Units::KILOMETERS)->getLongitude())->toEqualWithDelta(-179.0, FloatCompare::COMPARISON_TOLERANCE);
    expect((new LatLngAltitude(0.0, -180.0, 0.0))->move(Heading::WEST, Latitude::KILOMETERS_PER_DEGREE, Units::KILOMETERS)->getLongitude())->toEqualWithDelta(179.0, FloatCompare::COMPARISON_TOLERANCE);
});

it('respects the altitude limits in every movement', function (): void {
    expect((new LatLngAltitude(0.0, 0.0, -LatLngAltitude::EARTH_RADIUS))->move(Heading::DOWN, 100.0, Units::METERS)->getAltitude())->toEqualWithDelta(-LatLngAltitude::EARTH_RADIUS, FloatCompare::COMPARISON_TOLERANCE);
    expect((new LatLngAltitude(0.0, 0.0, -LatLngAltitude::EARTH_RADIUS))->move(Heading::UP, -100.0, Units::METERS)->getAltitude())->toEqualWithDelta(-LatLngAltitude::EARTH_RADIUS, FloatCompare::COMPARISON_TOLERANCE);
});

it('can move the point repeatedly', function (): void {
    $latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))
        ->move(Heading::NORTH, 10.0)
        ->move(Heading::SOUTH, 1.0)
        ->move(Heading::EAST, 20.0)
        ->move(Heading::WEST, 5.0)
        ->move(Heading::UP, 100.0, Units::METERS)
        ->move(Heading::DOWN, 30.0, Units::METERS);

    expect($latLngAlt->getLatitude())->toEqualWithDelta(10.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngAlt->getLongitude())->toEqualWithDelta(19.56, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngAlt->getAltitude())->toEqualWithDelta(70.0, FloatCompare::COMPARISON_TOLERANCE);
});
