<?php

declare(strict_types=1);

use Powlam\Coordinates\Enums\Heading;
use Powlam\Coordinates\Enums\Units;
use Powlam\Coordinates\LatLng;
use Powlam\Coordinates\Utils\FloatCompare;
use Powlam\Coordinates\Utils\Latitude;
use Powlam\Coordinates\Utils\Longitude;

it('can move the point north', function (): void {
    $latLng = (new LatLng(1.23, 4.56))->move(Heading::NORTH, 1.0);

    expect($latLng->getLatitude())->toEqualWithDelta(2.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(4.56, FloatCompare::COMPARISON_TOLERANCE);
});

it('can move the point south', function (): void {
    $latLng = (new LatLng(1.23, 4.56))->move(Heading::SOUTH, 1.0);

    expect($latLng->getLatitude())->toEqualWithDelta(0.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(4.56, FloatCompare::COMPARISON_TOLERANCE);
});

it('can move the point east', function (): void {
    $latLng = (new LatLng(1.23, 4.56))->move(Heading::EAST, 1.0);

    expect($latLng->getLatitude())->toEqualWithDelta(1.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(5.56, FloatCompare::COMPARISON_TOLERANCE);
});

it('can move the point west', function (): void {
    $latLng = (new LatLng(1.23, 4.56))->move(Heading::WEST, 1.0);

    expect($latLng->getLatitude())->toEqualWithDelta(1.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(3.56, FloatCompare::COMPARISON_TOLERANCE);
});

it('can move the point north in (kilo)meters', function (): void {
    $latLng = (new LatLng(1.23, 4.56))->move(Heading::NORTH, Latitude::METERS_PER_DEGREE, Units::METERS);

    expect($latLng->getLatitude())->toEqualWithDelta(2.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(4.56, FloatCompare::COMPARISON_TOLERANCE);

    $latLng = (new LatLng(1.23, 4.56))->move(Heading::NORTH, Latitude::KILOMETERS_PER_DEGREE, Units::KILOMETERS);

    expect($latLng->getLatitude())->toEqualWithDelta(2.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(4.56, FloatCompare::COMPARISON_TOLERANCE);
});

it('can move the point south in (kilo)meters', function (): void {
    $latLng = (new LatLng(1.23, 4.56))->move(Heading::SOUTH, Latitude::METERS_PER_DEGREE, Units::METERS);

    expect($latLng->getLatitude())->toEqualWithDelta(0.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(4.56, FloatCompare::COMPARISON_TOLERANCE);

    $latLng = (new LatLng(1.23, 4.56))->move(Heading::SOUTH, Latitude::KILOMETERS_PER_DEGREE, Units::KILOMETERS);

    expect($latLng->getLatitude())->toEqualWithDelta(0.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(4.56, FloatCompare::COMPARISON_TOLERANCE);
});

it('can move the point east in (kilo)meters', function (): void {
    $latLng = (new LatLng(31.23, 4.56))->move(Heading::EAST, Longitude::metersFromDegrees(1.0, 31.23), Units::METERS);

    expect($latLng->getLatitude())->toEqualWithDelta(31.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(5.56, FloatCompare::COMPARISON_TOLERANCE);

    $latLng = (new LatLng(31.23, 4.56))->move(Heading::EAST, Longitude::kilometersFromDegrees(1.0, 31.23), Units::KILOMETERS);

    expect($latLng->getLatitude())->toEqualWithDelta(31.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(5.56, FloatCompare::COMPARISON_TOLERANCE);

    $latLng = (new LatLng(0.00, 4.56))->move(Heading::EAST, Longitude::metersFromDegrees(1.0, 0.0), Units::METERS);

    expect($latLng->getLatitude())->toEqualWithDelta(0.00, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(5.56, FloatCompare::COMPARISON_TOLERANCE);

    $latLng = (new LatLng(0.00, 4.56))->move(Heading::EAST, Longitude::kilometersFromDegrees(1.0, 0.0), Units::KILOMETERS);

    expect($latLng->getLatitude())->toEqualWithDelta(0.00, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(5.56, FloatCompare::COMPARISON_TOLERANCE);
});

it('can move the point west in (kilo)meters', function (): void {
    $latLng = (new LatLng(31.23, 4.56))->move(Heading::WEST, Longitude::metersFromDegrees(1.0, 31.23), Units::METERS);

    expect($latLng->getLatitude())->toEqualWithDelta(31.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(3.56, FloatCompare::COMPARISON_TOLERANCE);

    $latLng = (new LatLng(31.23, 4.56))->move(Heading::WEST, Longitude::kilometersFromDegrees(1.0, 31.23), Units::KILOMETERS);

    expect($latLng->getLatitude())->toEqualWithDelta(31.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(3.56, FloatCompare::COMPARISON_TOLERANCE);

    $latLng = (new LatLng(0.00, 4.56))->move(Heading::WEST, Longitude::metersFromDegrees(1.0, 0.0), Units::METERS);

    expect($latLng->getLatitude())->toEqualWithDelta(0.00, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(3.56, FloatCompare::COMPARISON_TOLERANCE);

    $latLng = (new LatLng(0.00, 4.56))->move(Heading::WEST, Longitude::kilometersFromDegrees(1.0, 0.0), Units::KILOMETERS);

    expect($latLng->getLatitude())->toEqualWithDelta(0.00, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(3.56, FloatCompare::COMPARISON_TOLERANCE);
});

it('respects the latitude limits in every movement', function (): void {
    expect((new LatLng(-90.0, 0.0))->move(Heading::SOUTH, 1.0)->getLatitude())->toEqualWithDelta(-90.0, FloatCompare::COMPARISON_TOLERANCE);
    expect((new LatLng(90.0, 0.0))->move(Heading::NORTH, 1.0)->getLatitude())->toEqualWithDelta(90.0, FloatCompare::COMPARISON_TOLERANCE);

    expect((new LatLng(-90.0, 0.0))->move(Heading::SOUTH, Latitude::METERS_PER_DEGREE, Units::METERS)->getLatitude())->toEqualWithDelta(-90.0, FloatCompare::COMPARISON_TOLERANCE);
    expect((new LatLng(90.0, 0.0))->move(Heading::NORTH, Latitude::METERS_PER_DEGREE, Units::METERS)->getLatitude())->toEqualWithDelta(90.0, FloatCompare::COMPARISON_TOLERANCE);

    expect((new LatLng(-90.0, 0.0))->move(Heading::SOUTH, Latitude::KILOMETERS_PER_DEGREE, Units::KILOMETERS)->getLatitude())->toEqualWithDelta(-90.0, FloatCompare::COMPARISON_TOLERANCE);
    expect((new LatLng(90.0, 0.0))->move(Heading::NORTH, Latitude::KILOMETERS_PER_DEGREE, Units::KILOMETERS)->getLatitude())->toEqualWithDelta(90.0, FloatCompare::COMPARISON_TOLERANCE);
});

it('respects the longitude limits in every movement', function (): void {
    expect((new LatLng(0.0, 180.0))->move(Heading::EAST, 1.0)->getLongitude())->toEqualWithDelta(-179.0, FloatCompare::COMPARISON_TOLERANCE);
    expect((new LatLng(0.0, -180.0))->move(Heading::WEST, 1.0)->getLongitude())->toEqualWithDelta(179.0, FloatCompare::COMPARISON_TOLERANCE);

    expect((new LatLng(0.0, 180.0))->move(Heading::EAST, Latitude::METERS_PER_DEGREE, Units::METERS)->getLongitude())->toEqualWithDelta(-179.0, FloatCompare::COMPARISON_TOLERANCE);
    expect((new LatLng(0.0, -180.0))->move(Heading::WEST, Latitude::METERS_PER_DEGREE, Units::METERS)->getLongitude())->toEqualWithDelta(179.0, FloatCompare::COMPARISON_TOLERANCE);

    expect((new LatLng(0.0, 180.0))->move(Heading::EAST, Latitude::KILOMETERS_PER_DEGREE, Units::KILOMETERS)->getLongitude())->toEqualWithDelta(-179.0, FloatCompare::COMPARISON_TOLERANCE);
    expect((new LatLng(0.0, -180.0))->move(Heading::WEST, Latitude::KILOMETERS_PER_DEGREE, Units::KILOMETERS)->getLongitude())->toEqualWithDelta(179.0, FloatCompare::COMPARISON_TOLERANCE);
});

it('throws an exception when moving towards an invalid heading', function (): void {
    (new LatLng(1.23, 4.56))->move(Heading::UP, 1.0);
})->throws(InvalidArgumentException::class);

it('can move the point repeatedly', function (): void {
    $latLng = (new LatLng(1.23, 4.56))
        ->move(Heading::NORTH, 10.0)
        ->move(Heading::SOUTH, 1.0)
        ->move(Heading::EAST, 20.0)
        ->move(Heading::WEST, 5.0);

    expect($latLng->getLatitude())->toEqualWithDelta(10.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(19.56, FloatCompare::COMPARISON_TOLERANCE);
});
