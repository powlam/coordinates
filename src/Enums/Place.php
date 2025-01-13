<?php

namespace Powlam\Coordinates\Enums;

use Powlam\Coordinates\LatLng;
use Powlam\Coordinates\LatLngAltitude;
use Powlam\Coordinates\LatLngBounds;

enum Place
{
    case EARTH_CENTER;

    case NORTH_POLE;
    case NORTHERN_HEMISPHERE;
    case EQUATOR;
    case SOUTHERN_HEMISPHERE;
    case SOUTH_POLE;

    case ARCTIC;
    case ARCTIC_CIRCLE;
    case NORTH_TEMPERATE_ZONE;
    case TROPIC_OF_CANCER;
    case TROPICS;
    case TROPIC_OF_CAPRICORN;
    case SOUTH_TEMPERATE_ZONE;
    case ANTARCTIC_CIRCLE;
    case ANTARCTIC;

    case PRIME_MERIDIAN;
    case INTERNATIONAL_DATE_LINE;
    case WESTERN_HEMISPHERE;
    case EASTERN_HEMISPHERE;

    public function name(): string
    {
        return match ($this) {
            self::EARTH_CENTER => 'Earth Center',
            self::NORTH_POLE => 'North Pole',
            self::NORTHERN_HEMISPHERE => 'Northern Hemisphere',
            self::EQUATOR => 'Equator',
            self::SOUTHERN_HEMISPHERE => 'Southern Hemisphere',
            self::SOUTH_POLE => 'South Pole',
            self::ARCTIC => 'Arctic',
            self::ARCTIC_CIRCLE => 'Arctic Circle',
            self::NORTH_TEMPERATE_ZONE => 'North Temperate Zone',
            self::TROPIC_OF_CANCER => 'Tropic of Cancer',
            self::TROPICS => 'Tropics',
            self::TROPIC_OF_CAPRICORN => 'Tropic of Capricorn',
            self::SOUTH_TEMPERATE_ZONE => 'South Temperate Zone',
            self::ANTARCTIC_CIRCLE => 'Antarctic Circle',
            self::ANTARCTIC => 'Antarctic',
            self::PRIME_MERIDIAN => 'Prime Meridian',
            self::INTERNATIONAL_DATE_LINE => 'International Date Line',
            self::WESTERN_HEMISPHERE => 'Western Hemisphere',
            self::EASTERN_HEMISPHERE => 'Eastern Hemisphere',
        };
    }

    public function get(): LatLng|LatLngAltitude|LatLngBounds
    {
        return match ($this) {
            self::EARTH_CENTER => new LatLngAltitude(0.0, 0.0, -LatLngAltitude::EARTH_RADIUS),
            self::NORTH_POLE => new LatLng(90.0, 0.0),
            self::NORTHERN_HEMISPHERE => new LatLngBounds(new LatLng(0.0, -180.0), new LatLng(90.0, 180.0)),
            self::EQUATOR => new LatLngBounds(new LatLng(0.0, -180.0), new LatLng(0.0, 180.0)),
            self::SOUTHERN_HEMISPHERE => new LatLngBounds(new LatLng(-90.0, -180.0), new LatLng(0.0, 180.0)),
            self::SOUTH_POLE => new LatLng(-90.0, 0.0),
            self::ARCTIC => new LatLngBounds(new LatLng(66.563972, -180.0), new LatLng(90.0, 180.0)),
            self::ARCTIC_CIRCLE => new LatLngBounds(new LatLng(66.563972, -180.0), new LatLng(66.563972, 180.0)),
            self::NORTH_TEMPERATE_ZONE => new LatLngBounds(new LatLng(23.437778, -180.0), new LatLng(66.563972, 180.0)),
            self::TROPIC_OF_CANCER => new LatLngBounds(new LatLng(23.437778, -180.0), new LatLng(23.437778, 180.0)),
            self::TROPICS => new LatLngBounds(new LatLng(-23.437778, -180.0), new LatLng(23.437778, 180.0)),
            self::TROPIC_OF_CAPRICORN => new LatLngBounds(new LatLng(-23.437778, -180.0), new LatLng(-23.437778, 180.0)),
            self::SOUTH_TEMPERATE_ZONE => new LatLngBounds(new LatLng(-66.563972, -180.0), new LatLng(-23.437778, 180.0)),
            self::ANTARCTIC_CIRCLE => new LatLngBounds(new LatLng(-66.563972, -180.0), new LatLng(-66.563972, 180.0)),
            self::ANTARCTIC => new LatLngBounds(new LatLng(-90.0, -180.0), new LatLng(-66.563972, 180.0)),
            self::PRIME_MERIDIAN => new LatLngBounds(new LatLng(-90.0, 0.0), new LatLng(90.0, 0.0)),
            self::INTERNATIONAL_DATE_LINE => new LatLngBounds(new LatLng(-90.0, 180.0), new LatLng(90.0, 180.0)),
            self::WESTERN_HEMISPHERE => new LatLngBounds(new LatLng(-90.0, -180.0), new LatLng(90.0, 0.0)),
            self::EASTERN_HEMISPHERE => new LatLngBounds(new LatLng(-90.0, 0.0), new LatLng(90.0, 180.0)),
        };
    }
}
