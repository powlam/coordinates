<?php

declare(strict_types=1);

use Powlam\Coordinates\LatLng;
use Powlam\Coordinates\LatLngBounds;

it('should return true if the bounds contains a point', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 1), new LatLng(10, 10));

    expect($bounds->contains(new LatLng(5, 5)))->toBeTrue();

    $bounds = new LatLngBounds(new LatLng(-1, -1), new LatLng(10, 10));

    expect($bounds->contains(new LatLng(5, 5)))->toBeTrue();

    $bounds = new LatLngBounds(new LatLng(0, 160), new LatLng(10, -160));

    expect($bounds->contains(new LatLng(5, 170)))->toBeTrue();
    expect($bounds->contains(new LatLng(5, -170)))->toBeTrue();
});

it('should return false if the bounds does not contain a point', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 1), new LatLng(10, 10));

    expect($bounds->contains(new LatLng(15, 15)))->toBeFalse();
    expect($bounds->contains(new LatLng(0, 0)))->toBeFalse();
    expect($bounds->contains(new LatLng(5, -10)))->toBeFalse();
    expect($bounds->contains(new LatLng(-10, 5)))->toBeFalse();

    $bounds = new LatLngBounds(new LatLng(-1, -1), new LatLng(10, 10));

    expect($bounds->contains(new LatLng(15, 15)))->toBeFalse();
    expect($bounds->contains(new LatLng(5, -10)))->toBeFalse();
    expect($bounds->contains(new LatLng(-10, 5)))->toBeFalse();

    $bounds = new LatLngBounds(new LatLng(0, 160), new LatLng(10, -160));

    expect($bounds->contains(new LatLng(50, 50)))->toBeFalse();
    expect($bounds->contains(new LatLng(5, 150)))->toBeFalse();
    expect($bounds->contains(new LatLng(5, -150)))->toBeFalse();
});

it('should return true if the bounds intersects another bounds', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 1), new LatLng(10, 10));

    expect($bounds->intersects(new LatLngBounds(new LatLng(5, 5), new LatLng(15, 15))))->toBeTrue();
    expect($bounds->intersects(new LatLngBounds(new LatLng(-10, -10), new LatLng(5, 5))))->toBeTrue();
    expect($bounds->intersects(new LatLngBounds(new LatLng(-10, 5), new LatLng(5, 15))))->toBeTrue();
    expect($bounds->intersects(new LatLngBounds(new LatLng(5, -10), new LatLng(15, 5))))->toBeTrue();
    expect($bounds->intersects(new LatLngBounds(new LatLng(0, 0), new LatLng(15, 15))))->toBeTrue();
    expect($bounds->intersects(new LatLngBounds(new LatLng(2, 2), new LatLng(9, 9))))->toBeTrue();
    expect($bounds->intersects(new LatLngBounds(new LatLng(2, 160), new LatLng(9, 9))))->toBeTrue();
    expect($bounds->intersects(new LatLngBounds(new LatLng(2, 2), new LatLng(9, -160))))->toBeTrue();

    $bounds = new LatLngBounds(new LatLng(0, 160), new LatLng(10, -160));

    expect($bounds->intersects(new LatLngBounds(new LatLng(5, 150), new LatLng(15, 170))))->toBeTrue();
    expect($bounds->intersects(new LatLngBounds(new LatLng(5, -170), new LatLng(15, -150))))->toBeTrue();
    expect($bounds->intersects(new LatLngBounds(new LatLng(5, 150), new LatLng(15, -150))))->toBeTrue();
    expect($bounds->intersects(new LatLngBounds(new LatLng(5, -170), new LatLng(15, 170))))->toBeTrue();
    expect($bounds->intersects(new LatLngBounds(new LatLng(-5, 150), new LatLng(15, -150))))->toBeTrue();
    expect($bounds->intersects(new LatLngBounds(new LatLng(1, 170), new LatLng(9, -170))))->toBeTrue();
    expect($bounds->intersects(new LatLngBounds(new LatLng(-1, -170), new LatLng(1, -159))))->toBeTrue();
});

it('should return false if the bounds does not intersect another bounds', function (): void {
    $bounds = new LatLngBounds(new LatLng(1, 1), new LatLng(10, 10));

    expect($bounds->intersects(new LatLngBounds(new LatLng(15, 15), new LatLng(20, 20))))->toBeFalse();
    expect($bounds->intersects(new LatLngBounds(new LatLng(-10, -10), new LatLng(-5, -5))))->toBeFalse();
    expect($bounds->intersects(new LatLngBounds(new LatLng(-10, 5), new LatLng(-5, 20))))->toBeFalse();
    expect($bounds->intersects(new LatLngBounds(new LatLng(1, 160), new LatLng(20, -5))))->toBeFalse();
    expect($bounds->intersects(new LatLngBounds(new LatLng(1, 15), new LatLng(20, -170))))->toBeFalse();

    $bounds = new LatLngBounds(new LatLng(0, 160), new LatLng(10, -160));

    expect($bounds->intersects(new LatLngBounds(new LatLng(15, 150), new LatLng(20, 170))))->toBeFalse();
    expect($bounds->intersects(new LatLngBounds(new LatLng(15, -170), new LatLng(20, -150))))->toBeFalse();
    expect($bounds->intersects(new LatLngBounds(new LatLng(15, 150), new LatLng(20, -150))))->toBeFalse();
    expect($bounds->intersects(new LatLngBounds(new LatLng(15, -170), new LatLng(20, 170))))->toBeFalse();
    expect($bounds->intersects(new LatLngBounds(new LatLng(-15, 150), new LatLng(-10, -150))))->toBeFalse();
    expect($bounds->intersects(new LatLngBounds(new LatLng(1, -150), new LatLng(20, 150))))->toBeFalse();
});
