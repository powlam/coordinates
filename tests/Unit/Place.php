<?php

declare(strict_types=1);

use Powlam\Coordinates\Enums\Place;
use Powlam\Coordinates\LatLng;
use Powlam\Coordinates\LatLngAltitude;
use Powlam\Coordinates\LatLngBounds;

it('knows the Earth Center', function (): void {
    $earthCenter = Place::EARTH_CENTER->get();

    expect($earthCenter)->toBeInstanceOf(LatLngAltitude::class);
    expect($earthCenter->getAltitude())->toEqual(-LatLngAltitude::EARTH_RADIUS);
    expect(Place::EARTH_CENTER->name())->toEqual('Earth Center');
});

it('knows the North Pole', function (): void {
    $northPole = Place::NORTH_POLE->get();

    expect($northPole)->toBeInstanceOf(LatLng::class);
    expect($northPole->getLatitude())->toEqual(90.0);
    expect(Place::NORTH_POLE->name())->toEqual('North Pole');
});

it('knows the Northern Hemisphere', function (): void {
    $northernHemisphere = Place::NORTHERN_HEMISPHERE->get();

    expect($northernHemisphere)->toBeInstanceOf(LatLngBounds::class);
    if (is_a($northernHemisphere, LatLngBounds::class)) {
        expect($northernHemisphere->includesEquator())->toBeTrue();
        expect($northernHemisphere->includesNorthPole())->toBeTrue();
    }
    expect(Place::NORTHERN_HEMISPHERE->name())->toEqual('Northern Hemisphere');
});

it('knows the Equator', function (): void {
    $equator = Place::EQUATOR->get();

    expect($equator)->toBeInstanceOf(LatLngBounds::class);
    if (is_a($equator, LatLngBounds::class)) {
        expect($equator->isParallel())->toBeTrue();
        expect($equator->includesEquator())->toBeTrue();
    }
    expect(Place::EQUATOR->name())->toEqual('Equator');
});

it('knows the Southern Hemisphere', function (): void {
    $southernHemisphere = Place::SOUTHERN_HEMISPHERE->get();

    expect($southernHemisphere)->toBeInstanceOf(LatLngBounds::class);
    if (is_a($southernHemisphere, LatLngBounds::class)) {
        expect($southernHemisphere->includesEquator())->toBeTrue();
        expect($southernHemisphere->includesSouthPole())->toBeTrue();
    }
    expect(Place::SOUTHERN_HEMISPHERE->name())->toEqual('Southern Hemisphere');
});

it('knows the South Pole', function (): void {
    $southPole = Place::SOUTH_POLE->get();

    expect($southPole)->toBeInstanceOf(LatLng::class);
    expect($southPole->getLatitude())->toEqual(-90.0);
    expect(Place::SOUTH_POLE->name())->toEqual('South Pole');
});

it('knows the Arctic', function (): void {
    $arctic = Place::ARCTIC->get();

    expect($arctic)->toBeInstanceOf(LatLngBounds::class);
    if (is_a($arctic, LatLngBounds::class)) {
        expect($arctic->getSouth())->toEqual(66.563972);
        expect($arctic->includesNorthPole())->toBeTrue();
    }
    expect(Place::ARCTIC->name())->toEqual('Arctic');
});

it('knows the Arctic Circle', function (): void {
    $arcticCircle = Place::ARCTIC_CIRCLE->get();

    expect($arcticCircle)->toBeInstanceOf(LatLngBounds::class);
    if (is_a($arcticCircle, LatLngBounds::class)) {
        expect($arcticCircle->isParallel())->toBeTrue();
        expect($arcticCircle->getSouth())->toEqual(66.563972);
    }
    expect(Place::ARCTIC_CIRCLE->name())->toEqual('Arctic Circle');
});

it('knows the North Temperate Zone', function (): void {
    $northTemperateZone = Place::NORTH_TEMPERATE_ZONE->get();

    expect($northTemperateZone)->toBeInstanceOf(LatLngBounds::class);
    if (is_a($northTemperateZone, LatLngBounds::class)) {
        expect($northTemperateZone->getSouth())->toEqual(23.437778);
        expect($northTemperateZone->getNorth())->toEqual(66.563972);
    }
    expect(Place::NORTH_TEMPERATE_ZONE->name())->toEqual('North Temperate Zone');
});

it('knows the Tropic of Cancer', function (): void {
    $tropicOfCancer = Place::TROPIC_OF_CANCER->get();

    expect($tropicOfCancer)->toBeInstanceOf(LatLngBounds::class);
    if (is_a($tropicOfCancer, LatLngBounds::class)) {
        expect($tropicOfCancer->isParallel())->toBeTrue();
        expect($tropicOfCancer->getSouth())->toEqual(23.437778);
    }
    expect(Place::TROPIC_OF_CANCER->name())->toEqual('Tropic of Cancer');
});

it('knows the Tropics', function (): void {
    $tropics = Place::TROPICS->get();

    expect($tropics)->toBeInstanceOf(LatLngBounds::class);
    if (is_a($tropics, LatLngBounds::class)) {
        expect($tropics->getSouth())->toEqual(-23.437778);
        expect($tropics->getNorth())->toEqual(23.437778);
        expect($tropics->includesEquator())->toBeTrue();
    }
    expect(Place::TROPICS->name())->toEqual('Tropics');
});

it('knows the Tropic of Capricorn', function (): void {
    $tropicOfCapricorn = Place::TROPIC_OF_CAPRICORN->get();

    expect($tropicOfCapricorn)->toBeInstanceOf(LatLngBounds::class);
    if (is_a($tropicOfCapricorn, LatLngBounds::class)) {
        expect($tropicOfCapricorn->isParallel())->toBeTrue();
        expect($tropicOfCapricorn->getSouth())->toEqual(-23.437778);
    }
    expect(Place::TROPIC_OF_CAPRICORN->name())->toEqual('Tropic of Capricorn');
});

it('knows the South Temperate Zone', function (): void {
    $southTemperateZone = Place::SOUTH_TEMPERATE_ZONE->get();

    expect($southTemperateZone)->toBeInstanceOf(LatLngBounds::class);
    if (is_a($southTemperateZone, LatLngBounds::class)) {
        expect($southTemperateZone->getSouth())->toEqual(-66.563972);
        expect($southTemperateZone->getNorth())->toEqual(-23.437778);
    }
    expect(Place::SOUTH_TEMPERATE_ZONE->name())->toEqual('South Temperate Zone');
});

it('knows the Antarctic Circle', function (): void {
    $antarcticCircle = Place::ANTARCTIC_CIRCLE->get();

    expect($antarcticCircle)->toBeInstanceOf(LatLngBounds::class);
    if (is_a($antarcticCircle, LatLngBounds::class)) {
        expect($antarcticCircle->isParallel())->toBeTrue();
        expect($antarcticCircle->getSouth())->toEqual(-66.563972);
    }
    expect(Place::ANTARCTIC_CIRCLE->name())->toEqual('Antarctic Circle');
});

it('knows the Antarctic', function (): void {
    $antarctic = Place::ANTARCTIC->get();

    expect($antarctic)->toBeInstanceOf(LatLngBounds::class);
    if (is_a($antarctic, LatLngBounds::class)) {
        expect($antarctic->getNorth())->toEqual(-66.563972);
        expect($antarctic->includesSouthPole())->toBeTrue();
    }
    expect(Place::ANTARCTIC->name())->toEqual('Antarctic');
});

it('knows the Prime Meridian', function (): void {
    $primeMeridian = Place::PRIME_MERIDIAN->get();

    expect($primeMeridian)->toBeInstanceOf(LatLngBounds::class);
    if (is_a($primeMeridian, LatLngBounds::class)) {
        expect($primeMeridian->isMeridian())->toBeTrue();
        expect($primeMeridian->getWest())->toEqual(0.0);
    }
    expect(Place::PRIME_MERIDIAN->name())->toEqual('Prime Meridian');
});

it('knows the International Date Line', function (): void {
    $internationalDateLine = Place::INTERNATIONAL_DATE_LINE->get();

    expect($internationalDateLine)->toBeInstanceOf(LatLngBounds::class);
    if (is_a($internationalDateLine, LatLngBounds::class)) {
        expect($internationalDateLine->isMeridian())->toBeTrue();
        expect($internationalDateLine->getWest())->toEqual(180.0);
    }
    expect(Place::INTERNATIONAL_DATE_LINE->name())->toEqual('International Date Line');
});

it('knows the Western Hemisphere', function (): void {
    $westernHemisphere = Place::WESTERN_HEMISPHERE->get();

    expect($westernHemisphere)->toBeInstanceOf(LatLngBounds::class);
    if (is_a($westernHemisphere, LatLngBounds::class)) {
        expect($westernHemisphere->getWest())->toEqual(-180.0);
        expect($westernHemisphere->getEast())->toEqual(0.0);
        expect($westernHemisphere->includesBothPoles())->toBeTrue();
    }
    expect(Place::WESTERN_HEMISPHERE->name())->toEqual('Western Hemisphere');
});

it('knows the Eastern Hemisphere', function (): void {
    $easternHemisphere = Place::EASTERN_HEMISPHERE->get();

    expect($easternHemisphere)->toBeInstanceOf(LatLngBounds::class);
    if (is_a($easternHemisphere, LatLngBounds::class)) {
        expect($easternHemisphere->getWest())->toEqual(0.0);
        expect($easternHemisphere->getEast())->toEqual(180.0);
        expect($easternHemisphere->includesBothPoles())->toBeTrue();
    }
    expect(Place::EASTERN_HEMISPHERE->name())->toEqual('Eastern Hemisphere');
});
