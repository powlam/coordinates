<?php

declare(strict_types=1);

use Powlam\Coordinates\LatLng;
use Powlam\Coordinates\LatLngBounds;

it('should throw an exception if the southwest corner is north of the northeast corner', function (): void {
    new LatLngBounds(new LatLng(1, 1), new LatLng(0, 0));
})->throws(InvalidArgumentException::class, 'The southwest corner must be south of the northeast corner.');

it('should return the southwest corner', function (): void {
    $southwest = new LatLng(1, 1);
    $northeast = new LatLng(10, 10);
    $bounds = new LatLngBounds($southwest, $northeast);

    expect($bounds->getSouthwest())->toBe($southwest);
});

it('should return the northeast corner', function (): void {
    $southwest = new LatLng(1, 1);
    $northeast = new LatLng(10, 10);
    $bounds = new LatLngBounds($southwest, $northeast);

    expect($bounds->getNortheast())->toBe($northeast);
});

it('should return the southeast corner', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 2), new LatLng(10, 20));

    expect($bounds->getSouthEast()->toArray())->toBe([
        'latitude' => 1.0,
        'longitude' => 20.0,
    ]);
});

it('should return the northwest corner', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 2), new LatLng(10, 20));

    expect($bounds->getNorthWest()->toArray())->toBe([
        'latitude' => 10.0,
        'longitude' => 2.0,
    ]);
});

it('should return the north edge', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 2), new LatLng(10, 20));

    expect($bounds->getNorth())->toBe(10.0);
});

it('should return the south edge', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 2), new LatLng(10, 20));

    expect($bounds->getSouth())->toBe(1.0);
});

it('should return the east edge', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 2), new LatLng(10, 20));

    expect($bounds->getEast())->toBe(20.0);
});

it('should return the west edge', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 2), new LatLng(10, 20));

    expect($bounds->getWest())->toBe(2.0);
});

it('should return true if the bounds includes the 180th meridian', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 179), new LatLng(10, -179));

    expect($bounds->includes180thMeridian())->toBeTrue();
});

it('should return false if the bounds does not include the 180th meridian', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 1), new LatLng(10, 10));

    expect($bounds->includes180thMeridian())->toBeFalse();
});

it('should return true if the bounds includes the 0th meridian', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, -1), new LatLng(10, 1));

    expect($bounds->includes0thMeridian())->toBeTrue();
});

it('should return false if the bounds does not include the 0th meridian', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 1), new LatLng(10, 10));

    expect($bounds->includes0thMeridian())->toBeFalse();
});

it('should return true if the bounds includes the nth meridian', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, -1), new LatLng(10, 1));

    expect($bounds->includesNthMeridian(1))->toBeTrue();
});

it('should return false if the bounds does not include the nth meridian', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 2), new LatLng(10, 10));

    expect($bounds->includesNthMeridian(1))->toBeFalse();
});

it('should return true if the bounds includes a pole', function (): void {
    $bounds = new LatLngBounds(new LatLng(-90, 1), new LatLng(-90, 10));

    expect($bounds->includesAPole())->toBeTrue();
});

it('should return false if the bounds does not include a pole', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 1), new LatLng(10, 10));

    expect($bounds->includesAPole())->toBeFalse();
});

it('should return true if the bounds includes both poles', function (): void {
    $bounds = new LatLngBounds(new LatLng(-90, 1), new LatLng(90, 10));

    expect($bounds->includesBothPoles())->toBeTrue();
});

it('should return false if the bounds does not include both poles', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 1), new LatLng(10, 10));

    expect($bounds->includesBothPoles())->toBeFalse();
});

it('should return true if the bounds includes the north pole', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 1), new LatLng(90, 10));

    expect($bounds->includesNorthPole())->toBeTrue();
});

it('should return false if the bounds does not include the north pole', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 1), new LatLng(10, 10));

    expect($bounds->includesNorthPole())->toBeFalse();
});

it('should return true if the bounds includes the south pole', function (): void {
    $bounds = new LatLngBounds(new LatLng(-90, 1), new LatLng(1, 10));

    expect($bounds->includesSouthPole())->toBeTrue();
});

it('should return false if the bounds does not include the south pole', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 1), new LatLng(10, 10));

    expect($bounds->includesSouthPole())->toBeFalse();
});

it('should return true if the bounds includes the equator', function (): void {
    $bounds = new LatLngBounds(new LatLng(-1, 1), new LatLng(1, 10));

    expect($bounds->includesEquator())->toBeTrue();
});

it('should return false if the bounds does not include the equator', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 1), new LatLng(10, 10));

    expect($bounds->includesEquator())->toBeFalse();
});

it('should return true if it is a line', function (): void {
    $bounds1 = new LatLngBounds(new LatLng(1, 1), new LatLng(1, 10));
    $bounds2 = new LatLngBounds(new LatLng(1, 10), new LatLng(3, 10));

    expect($bounds1->isLine())->toBeTrue();
    expect($bounds2->isLine())->toBeTrue();
});

it('should return false if it is not a line', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 1), new LatLng(10, 10));

    expect($bounds->isLine())->toBeFalse();
});

it('should return true if it is a point', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 1), new LatLng(1, 1));

    expect($bounds->isPoint())->toBeTrue();
});

it('should return false if it is not a point', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 1), new LatLng(10, 10));

    expect($bounds->isPoint())->toBeFalse();
});

it('calculates the center of the bounds', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 2), new LatLng(10, 20));

    expect($bounds->getCenter()->toArray())->toBe([
        'latitude' => 5.5,
        'longitude' => 11.0,
    ]);

    $bounds = new LatLngBounds(new LatLng(-10, -20), new LatLng(10, 20));

    expect($bounds->getCenter()->toArray())->toBe([
        'latitude' => 0.0,
        'longitude' => 0.0,
    ]);

    $bounds = new LatLngBounds(new LatLng(90, 10), new LatLng(90, 20));

    expect($bounds->getCenter()->toArray())->toBe([
        'latitude' => 90.0,
        'longitude' => 15.0,
    ]);

    $bounds = new LatLngBounds(new LatLng(0, 170), new LatLng(10, -170));

    expect($bounds->getCenter()->toArray())->toBe([
        'latitude' => 5.0,
        'longitude' => 180.0,
    ]);
});

it('returns a string representation', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 2), new LatLng(10, 20));

    expect($bounds->__toString())->toBe('1.000000,2.000000|10.000000,20.000000');
});

it('returns an array', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 2), new LatLng(10, 20));

    expect($bounds->toArray())->toBe([
        'southwest' => [
            'latitude' => 1.0,
            'longitude' => 2.0,
        ],
        'northeast' => [
            'latitude' => 10.0,
            'longitude' => 20.0,
        ],
    ]);
});

it('returns the span contained into the bounds (the area)', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 2), new LatLng(10, 20));

    expect($bounds->toSpan())->toBe([
        'latitude' => 9.0,
        'longitude' => 18.0,
    ]);

    $bounds = new LatLngBounds(new LatLng(-10, 160), new LatLng(10, -150));

    expect($bounds->toSpan())->toBe([
        'latitude' => 20.0,
        'longitude' => 50.0,
    ]);

    $bounds = new LatLngBounds(new LatLng(-10, -160), new LatLng(10, 150));

    expect($bounds->toSpan())->toBe([
        'latitude' => 20.0,
        'longitude' => 310.0,
    ]);

    $bounds = new LatLngBounds(new LatLng(-10, -160), new LatLng(10, -160));

    expect($bounds->toSpan())->toBe([
        'latitude' => 20.0,
        'longitude' => 360.0,
    ]);
});

it('return a URL value', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 2), new LatLng(10, 20));

    expect($bounds->toUrlValue())->toBe('1.000000,2.000000|10.000000,20.000000');
});

it('returs a URL value without commas if precision is 0', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 2), new LatLng(10, 20));

    expect($bounds->toUrlValue(0))->toBe('1,2|10,20');
});

it('returns a JSON representation', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 2), new LatLng(10, 20));

    expect($bounds->toJson())->toBe('{"southwest":{"latitude":1,"longitude":2},"northeast":{"latitude":10,"longitude":20}}');
});

it('returns a GeoJSON representation', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 2), new LatLng(10, 20));

    expect($bounds->toGeoJson())->toBe('{"type":"Polygon","coordinates":[[[2,1],[20,1],[20,10],[2,10],[2,1]]]}');
});

it('can be created from arrays', function (): void {
    $bounds = LatLngBounds::fromArrays([
        'latitude' => 1.0,
        'longitude' => 2.0,
    ], [
        'latitude' => 10.0,
        'longitude' => 20.0,
    ]);

    expect($bounds->getSouthwest()->toArray())->toBe([
        'latitude' => 1.0,
        'longitude' => 2.0,
    ]);

    expect($bounds->getNortheast()->toArray())->toBe([
        'latitude' => 10.0,
        'longitude' => 20.0,
    ]);
});
