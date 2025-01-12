<?php

namespace Powlam\Coordinates\Enums;

use Powlam\Coordinates\LatLng;
use Powlam\Coordinates\LatLngAltitude;

enum Place
{
    case NORTH_POLE;
    case SOUTH_POLE;
    case EARTH_CENTER;

    public function name(): string
    {
        return match ($this) {
            self::NORTH_POLE => 'North Pole',
            self::SOUTH_POLE => 'South Pole',
            self::EARTH_CENTER => 'Earth Center',
        };
    }

    public function get(): LatLng|LatLngAltitude
    {
        return match ($this) {
            self::NORTH_POLE => new LatLng(90.0, 0.0),
            self::SOUTH_POLE => new LatLng(-90.0, 0.0),
            self::EARTH_CENTER => new LatLngAltitude(0.0, 0.0, -LatLngAltitude::EARTH_RADIUS),
        };
    }
}
