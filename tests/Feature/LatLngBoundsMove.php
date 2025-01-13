<?php

declare(strict_types=1);

use Powlam\Coordinates\Enums\Heading;
use Powlam\Coordinates\Enums\Units;
use Powlam\Coordinates\LatLng;
use Powlam\Coordinates\LatLngBounds;
use Powlam\Coordinates\Utils\FloatCompare;
use Powlam\Coordinates\Utils\Latitude;
use Powlam\Coordinates\Utils\Longitude;

it('can move the area north', function (): void {
    $latLngBounds = (new LatLngBounds(new LatLng(1.23, 4.56), new LatLng(7.89, 10.20)))->move(Heading::NORTH, 1.0);

    expect($latLngBounds->getSouth())->toEqualWithDelta(2.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getWest())->toEqualWithDelta(4.56, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getNorth())->toEqualWithDelta(8.89, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getEast())->toEqualWithDelta(10.20, FloatCompare::COMPARISON_TOLERANCE);
});

it('can move the area south', function (): void {
    $latLngBounds = (new LatLngBounds(new LatLng(1.23, 4.56), new LatLng(7.89, 10.20)))->move(Heading::SOUTH, 1.0);

    expect($latLngBounds->getSouth())->toEqualWithDelta(0.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getWest())->toEqualWithDelta(4.56, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getNorth())->toEqualWithDelta(6.89, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getEast())->toEqualWithDelta(10.20, FloatCompare::COMPARISON_TOLERANCE);
});

it('can move the area east', function (): void {
    $latLngBounds = (new LatLngBounds(new LatLng(1.23, 4.56), new LatLng(7.89, 10.20)))->move(Heading::EAST, 1.0);

    expect($latLngBounds->getSouth())->toEqualWithDelta(1.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getWest())->toEqualWithDelta(5.56, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getNorth())->toEqualWithDelta(7.89, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getEast())->toEqualWithDelta(11.20, FloatCompare::COMPARISON_TOLERANCE);
});

it('can move the area west', function (): void {
    $latLngBounds = (new LatLngBounds(new LatLng(1.23, 4.56), new LatLng(7.89, 10.20)))->move(Heading::WEST, 1.0);

    expect($latLngBounds->getSouth())->toEqualWithDelta(1.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getWest())->toEqualWithDelta(3.56, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getNorth())->toEqualWithDelta(7.89, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getEast())->toEqualWithDelta(9.20, FloatCompare::COMPARISON_TOLERANCE);
});

it('can move the area north in (kilo)meters', function (): void {
    $latLngBounds = (new LatLngBounds(new LatLng(1.23, 4.56), new LatLng(7.89, 10.20)))->move(Heading::NORTH, Latitude::METERS_PER_DEGREE, Units::METERS);

    expect($latLngBounds->getSouth())->toEqualWithDelta(2.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getWest())->toEqualWithDelta(4.56, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getNorth())->toEqualWithDelta(8.89, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getEast())->toEqualWithDelta(10.20, FloatCompare::COMPARISON_TOLERANCE);

    $latLngBounds = (new LatLngBounds(new LatLng(1.23, 4.56), new LatLng(7.89, 10.20)))->move(Heading::NORTH, Latitude::KILOMETERS_PER_DEGREE, Units::KILOMETERS);

    expect($latLngBounds->getSouth())->toEqualWithDelta(2.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getWest())->toEqualWithDelta(4.56, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getNorth())->toEqualWithDelta(8.89, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getEast())->toEqualWithDelta(10.20, FloatCompare::COMPARISON_TOLERANCE);
});

it('can move the area south in (kilo)meters', function (): void {
    $latLngBounds = (new LatLngBounds(new LatLng(1.23, 4.56), new LatLng(7.89, 10.20)))->move(Heading::SOUTH, Latitude::METERS_PER_DEGREE, Units::METERS);

    expect($latLngBounds->getSouth())->toEqualWithDelta(0.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getWest())->toEqualWithDelta(4.56, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getNorth())->toEqualWithDelta(6.89, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getEast())->toEqualWithDelta(10.20, FloatCompare::COMPARISON_TOLERANCE);

    $latLngBounds = (new LatLngBounds(new LatLng(1.23, 4.56), new LatLng(7.89, 10.20)))->move(Heading::SOUTH, Latitude::KILOMETERS_PER_DEGREE, Units::KILOMETERS);

    expect($latLngBounds->getSouth())->toEqualWithDelta(0.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getWest())->toEqualWithDelta(4.56, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getNorth())->toEqualWithDelta(6.89, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getEast())->toEqualWithDelta(10.20, FloatCompare::COMPARISON_TOLERANCE);
});

it('can move the area east in (kilo)meters', function (): void {
    // The corresponding degrees will be calculated based on the midpoint latitude of the area.
    $latLngBounds = (new LatLngBounds(new LatLng(31.23, 4.56), new LatLng(60.0, 10.0)))->move(Heading::EAST, Longitude::metersFromDegrees(1.0, (31.23 + 60.0) / 2), Units::METERS);

    expect($latLngBounds->getSouth())->toEqualWithDelta(31.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getWest())->toEqualWithDelta(5.56, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getNorth())->toEqualWithDelta(60.0, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getEast())->toEqualWithDelta(11.0, FloatCompare::COMPARISON_TOLERANCE);

    $latLngBounds = (new LatLngBounds(new LatLng(31.23, 4.56), new LatLng(60.0, 10.0)))->move(Heading::EAST, Longitude::kilometersFromDegrees(1.0, (31.23 + 60.0) / 2), Units::KILOMETERS);

    expect($latLngBounds->getSouth())->toEqualWithDelta(31.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getWest())->toEqualWithDelta(5.56, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getNorth())->toEqualWithDelta(60.0, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getEast())->toEqualWithDelta(11.0, FloatCompare::COMPARISON_TOLERANCE);
});

it('can move the area west in (kilo)meters', function (): void {
    $latLngBounds = (new LatLngBounds(new LatLng(31.23, 4.56), new LatLng(60.0, 10.0)))->move(Heading::WEST, Longitude::metersFromDegrees(1.0, (31.23 + 60.0) / 2), Units::METERS);

    expect($latLngBounds->getSouth())->toEqualWithDelta(31.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getWest())->toEqualWithDelta(3.56, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getNorth())->toEqualWithDelta(60.0, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getEast())->toEqualWithDelta(9.0, FloatCompare::COMPARISON_TOLERANCE);

    $latLngBounds = (new LatLngBounds(new LatLng(31.23, 4.56), new LatLng(60.0, 10.0)))->move(Heading::WEST, Longitude::kilometersFromDegrees(1.0, (31.23 + 60.0) / 2), Units::KILOMETERS);

    expect($latLngBounds->getSouth())->toEqualWithDelta(31.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getWest())->toEqualWithDelta(3.56, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getNorth())->toEqualWithDelta(60.0, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getEast())->toEqualWithDelta(9.0, FloatCompare::COMPARISON_TOLERANCE);
});

it('respects the latitude limits in every movement', function (): void {
    $latLngBounds = (new LatLngBounds(new LatLng(-90.0, 0.0), new LatLng(-80.0, 1.0)))->move(Heading::SOUTH, 10.0);
    expect($latLngBounds->getSouth())->toEqualWithDelta(-90.0, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getNorth())->toEqualWithDelta(-90.0, FloatCompare::COMPARISON_TOLERANCE);
    $latLngBounds = (new LatLngBounds(new LatLng(80.0, 0.0), new LatLng(90.0, 1.0)))->move(Heading::NORTH, 10.0);
    expect($latLngBounds->getSouth())->toEqualWithDelta(90.0, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getNorth())->toEqualWithDelta(90.0, FloatCompare::COMPARISON_TOLERANCE);

    $latLngBounds = (new LatLngBounds(new LatLng(-90.0, 0.0), new LatLng(-80.0, 1.0)))->move(Heading::SOUTH, Latitude::metersFromDegrees(10.0), Units::METERS);
    expect($latLngBounds->getSouth())->toEqualWithDelta(-90.0, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getNorth())->toEqualWithDelta(-90.0, FloatCompare::COMPARISON_TOLERANCE);
    $latLngBounds = (new LatLngBounds(new LatLng(80.0, 0.0), new LatLng(90.0, 1.0)))->move(Heading::NORTH, Latitude::metersFromDegrees(10.0), Units::METERS);
    expect($latLngBounds->getSouth())->toEqualWithDelta(90.0, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getNorth())->toEqualWithDelta(90.0, FloatCompare::COMPARISON_TOLERANCE);

    $latLngBounds = (new LatLngBounds(new LatLng(-90.0, 0.0), new LatLng(-80.0, 1.0)))->move(Heading::SOUTH, Latitude::kilometersFromDegrees(10.0), Units::KILOMETERS);
    expect($latLngBounds->getSouth())->toEqualWithDelta(-90.0, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getNorth())->toEqualWithDelta(-90.0, FloatCompare::COMPARISON_TOLERANCE);
    $latLngBounds = (new LatLngBounds(new LatLng(80.0, 0.0), new LatLng(90.0, 1.0)))->move(Heading::NORTH, Latitude::kilometersFromDegrees(10.0), Units::KILOMETERS);
    expect($latLngBounds->getSouth())->toEqualWithDelta(90.0, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getNorth())->toEqualWithDelta(90.0, FloatCompare::COMPARISON_TOLERANCE);
});

it('respects the longitude limits in every movement', function (): void {
    $latLngBounds = (new LatLngBounds(new LatLng(0.0, 170.0), new LatLng(10.0, 180.0)))->move(Heading::EAST, 10.0);
    expect(abs($latLngBounds->getWest()))->toEqualWithDelta(180.0, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getEast())->toEqualWithDelta(-170.0, FloatCompare::COMPARISON_TOLERANCE);
    $latLngBounds = (new LatLngBounds(new LatLng(0.0, -180.0), new LatLng(10.0, -170.0)))->move(Heading::WEST, 10.0);
    expect($latLngBounds->getWest())->toEqualWithDelta(170.0, FloatCompare::COMPARISON_TOLERANCE);
    expect(abs($latLngBounds->getEast()))->toEqualWithDelta(180.0, FloatCompare::COMPARISON_TOLERANCE);

    $latLngBounds = (new LatLngBounds(new LatLng(0.0, 170.0), new LatLng(1.0, 180.0)))->move(Heading::EAST, Longitude::metersFromDegrees(10.0, (0.0 + 1.0) / 2), Units::METERS);
    expect(abs($latLngBounds->getWest()))->toEqualWithDelta(180.0, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getEast())->toEqualWithDelta(-170.0, FloatCompare::COMPARISON_TOLERANCE);
    $latLngBounds = (new LatLngBounds(new LatLng(0.0, -180.0), new LatLng(10.0, -170.0)))->move(Heading::WEST, Longitude::metersFromDegrees(10.0, (0.0 + 10.0) / 2), Units::METERS);
    expect($latLngBounds->getWest())->toEqualWithDelta(170.0, FloatCompare::COMPARISON_TOLERANCE);
    expect(abs($latLngBounds->getEast()))->toEqualWithDelta(180.0, FloatCompare::COMPARISON_TOLERANCE);

    $latLngBounds = (new LatLngBounds(new LatLng(0.0, 170.0), new LatLng(1.0, 180.0)))->move(Heading::EAST, Longitude::kilometersFromDegrees(10.0, (0.0 + 1.0) / 2), Units::KILOMETERS);
    expect(abs($latLngBounds->getWest()))->toEqualWithDelta(180.0, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getEast())->toEqualWithDelta(-170.0, FloatCompare::COMPARISON_TOLERANCE);
    $latLngBounds = (new LatLngBounds(new LatLng(0.0, -180.0), new LatLng(10.0, -170.0)))->move(Heading::WEST, Longitude::kilometersFromDegrees(10.0, (0.0 + 10.0) / 2), Units::KILOMETERS);
    expect($latLngBounds->getWest())->toEqualWithDelta(170.0, FloatCompare::COMPARISON_TOLERANCE);
    expect(abs($latLngBounds->getEast()))->toEqualWithDelta(180.0, FloatCompare::COMPARISON_TOLERANCE);
});

it('throws an exception when moving towards an invalid heading', function (): void {
    (new LatLngBounds(new LatLng(-90.0, 0.0), new LatLng(-80.0, 1.0)))->move(Heading::UP, 1.0);
})->throws(InvalidArgumentException::class);

it('can move the area repeatedly', function (): void {
    $latLngBounds = (new LatLngBounds(new LatLng(1.23, 4.56), new LatLng(7.89, 10.20)))
        ->move(Heading::NORTH, 10.0)
        ->move(Heading::SOUTH, 1.0)
        ->move(Heading::EAST, 20.0)
        ->move(Heading::WEST, 5.0);

    expect($latLngBounds->getSouth())->toEqualWithDelta(10.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getWest())->toEqualWithDelta(19.56, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getNorth())->toEqualWithDelta(16.89, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLngBounds->getEast())->toEqualWithDelta(25.20, FloatCompare::COMPARISON_TOLERANCE);
});
