<?php

namespace Powlam\Coordinates\Utils;

class Latitude
{
    public const float METERS_PER_DEGREE = 111319.9;

    public const float KILOMETERS_PER_DEGREE = 111.3199;

    // 1 degree of latitude is always 111.3199 km

    public static function degreesFromMeters(float $meters): float
    {
        return $meters / self::METERS_PER_DEGREE;
    }

    public static function degreesFromKilometers(float $kilometers): float
    {
        return $kilometers / self::KILOMETERS_PER_DEGREE;
    }

    public static function metersPerDegree(): float
    {
        return self::METERS_PER_DEGREE;
    }

    public static function kilometersPerDegree(): float
    {
        return self::KILOMETERS_PER_DEGREE;
    }

    public static function metersFromDegrees(float $degrees): float
    {
        return $degrees * self::METERS_PER_DEGREE;
    }

    public static function kilometersFromDegrees(float $degrees): float
    {
        return $degrees * self::KILOMETERS_PER_DEGREE;
    }
}
