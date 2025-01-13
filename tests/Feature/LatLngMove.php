<?php

declare(strict_types=1);

use Powlam\Coordinates\Enums\Heading;
use Powlam\Coordinates\Enums\Units;
use Powlam\Coordinates\LatLng;
use Powlam\Coordinates\Utils\FloatCompare;

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
    $latLng = (new LatLng(1.23, 4.56))->move(Heading::NORTH, 111319.9, Units::METERS);

    expect($latLng->getLatitude())->toEqualWithDelta(2.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(4.56, FloatCompare::COMPARISON_TOLERANCE);

    $latLng = (new LatLng(1.23, 4.56))->move(Heading::NORTH, 111.3199, Units::KILOMETERS);

    expect($latLng->getLatitude())->toEqualWithDelta(2.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(4.56, FloatCompare::COMPARISON_TOLERANCE);
});

it('can move the point south in (kilo)meters', function (): void {
    $latLng = (new LatLng(1.23, 4.56))->move(Heading::SOUTH, 111319.9, Units::METERS);

    expect($latLng->getLatitude())->toEqualWithDelta(0.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(4.56, FloatCompare::COMPARISON_TOLERANCE);

    $latLng = (new LatLng(1.23, 4.56))->move(Heading::SOUTH, 111.3199, Units::KILOMETERS);

    expect($latLng->getLatitude())->toEqualWithDelta(0.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(4.56, FloatCompare::COMPARISON_TOLERANCE);
});

it('can move the point east in (kilo)meters', function (): void {
    // 1 degree of longitude is calculated as 111.3199 km * cos(deg2rad([latitude degree]))
    $latLng = (new LatLng(31.23, 4.56))->move(Heading::EAST, 111319.9 * cos(deg2rad(31.23)), Units::METERS);

    expect($latLng->getLatitude())->toEqualWithDelta(31.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(5.56, FloatCompare::COMPARISON_TOLERANCE);

    $latLng = (new LatLng(31.23, 4.56))->move(Heading::EAST, 111.3199 * cos(deg2rad(31.23)), Units::KILOMETERS);

    expect($latLng->getLatitude())->toEqualWithDelta(31.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(5.56, FloatCompare::COMPARISON_TOLERANCE);

    // 1 degree of longitude at the equator is 111.3199 km
    $latLng = (new LatLng(0.00, 4.56))->move(Heading::EAST, 111319.9 * cos(deg2rad(0.00)), Units::METERS);

    expect($latLng->getLatitude())->toEqualWithDelta(0.00, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(5.56, FloatCompare::COMPARISON_TOLERANCE);

    $latLng = (new LatLng(0.00, 4.56))->move(Heading::EAST, 111.3199 * cos(deg2rad(0.00)), Units::KILOMETERS);

    expect($latLng->getLatitude())->toEqualWithDelta(0.00, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(5.56, FloatCompare::COMPARISON_TOLERANCE);
});

it('can move the point west in (kilo)meters', function (): void {
    // 1 degree of longitude is calculated as 111.3199 km * cos(deg2rad([latitude degree]))
    $latLng = (new LatLng(31.23, 4.56))->move(Heading::WEST, 111319.9 * cos(deg2rad(31.23)), Units::METERS);

    expect($latLng->getLatitude())->toEqualWithDelta(31.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(3.56, FloatCompare::COMPARISON_TOLERANCE);

    $latLng = (new LatLng(31.23, 4.56))->move(Heading::WEST, 111.3199 * cos(deg2rad(31.23)), Units::KILOMETERS);

    expect($latLng->getLatitude())->toEqualWithDelta(31.23, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(3.56, FloatCompare::COMPARISON_TOLERANCE);

    // 1 degree of longitude at the equator is 111.3199 km
    $latLng = (new LatLng(0.00, 4.56))->move(Heading::WEST, 111319.9 * cos(deg2rad(0.00)), Units::METERS);

    expect($latLng->getLatitude())->toEqualWithDelta(0.00, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(3.56, FloatCompare::COMPARISON_TOLERANCE);

    $latLng = (new LatLng(0.00, 4.56))->move(Heading::WEST, 111.3199 * cos(deg2rad(0.00)), Units::KILOMETERS);

    expect($latLng->getLatitude())->toEqualWithDelta(0.00, FloatCompare::COMPARISON_TOLERANCE);
    expect($latLng->getLongitude())->toEqualWithDelta(3.56, FloatCompare::COMPARISON_TOLERANCE);
});

it('respects the latitude limits in every movement', function (): void {
    expect((new LatLng(-90.0, 0.0))->move(Heading::SOUTH, 1.0)->getLatitude())->toEqualWithDelta(-90.0, FloatCompare::COMPARISON_TOLERANCE);
    expect((new LatLng(90.0, 0.0))->move(Heading::NORTH, 1.0)->getLatitude())->toEqualWithDelta(90.0, FloatCompare::COMPARISON_TOLERANCE);

    expect((new LatLng(-90.0, 0.0))->move(Heading::SOUTH, 111319.9, Units::METERS)->getLatitude())->toEqualWithDelta(-90.0, FloatCompare::COMPARISON_TOLERANCE);
    expect((new LatLng(90.0, 0.0))->move(Heading::NORTH, 111319.9, Units::METERS)->getLatitude())->toEqualWithDelta(90.0, FloatCompare::COMPARISON_TOLERANCE);

    expect((new LatLng(-90.0, 0.0))->move(Heading::SOUTH, 111.3199, Units::KILOMETERS)->getLatitude())->toEqualWithDelta(-90.0, FloatCompare::COMPARISON_TOLERANCE);
    expect((new LatLng(90.0, 0.0))->move(Heading::NORTH, 111.3199, Units::KILOMETERS)->getLatitude())->toEqualWithDelta(90.0, FloatCompare::COMPARISON_TOLERANCE);
});

it('respects the longitude limits in every movement', function (): void {
    expect((new LatLng(0.0, 180.0))->move(Heading::EAST, 1.0)->getLongitude())->toEqualWithDelta(-179.0, FloatCompare::COMPARISON_TOLERANCE);
    expect((new LatLng(0.0, -180.0))->move(Heading::WEST, 1.0)->getLongitude())->toEqualWithDelta(179.0, FloatCompare::COMPARISON_TOLERANCE);

    expect((new LatLng(0.0, 180.0))->move(Heading::EAST, 111319.9, Units::METERS)->getLongitude())->toEqualWithDelta(-179.0, FloatCompare::COMPARISON_TOLERANCE);
    expect((new LatLng(0.0, -180.0))->move(Heading::WEST, 111319.9, Units::METERS)->getLongitude())->toEqualWithDelta(179.0, FloatCompare::COMPARISON_TOLERANCE);

    expect((new LatLng(0.0, 180.0))->move(Heading::EAST, 111.3199, Units::KILOMETERS)->getLongitude())->toEqualWithDelta(-179.0, FloatCompare::COMPARISON_TOLERANCE);
    expect((new LatLng(0.0, -180.0))->move(Heading::WEST, 111.3199, Units::KILOMETERS)->getLongitude())->toEqualWithDelta(179.0, FloatCompare::COMPARISON_TOLERANCE);
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
