<?php

namespace Powlam\Coordinates\Utils;

class Longitude
{
    public const float METERS_PER_DEGREE_AT_EQUATOR = 111319.9;

    public const float KILOMETERS_PER_DEGREE_AT_EQUATOR = 111.3199;

    // 1 degree of longitude is calculated as 111.3199 km * cos(deg2rad([latitude degree]))

    public static function degreesFromMeters(float $meters, float $latitudeDegrees): float
    {
        if (FloatCompare::equals(abs($latitudeDegrees), 90.0)) {
            return INF;
        }

        return $meters / (self::METERS_PER_DEGREE_AT_EQUATOR * cos(deg2rad($latitudeDegrees)));
    }

    public static function degreesFromKilometers(float $kilometers, float $latitudeDegrees): float
    {
        if (FloatCompare::equals(abs($latitudeDegrees), 90.0)) {
            return INF;
        }

        return $kilometers / (self::KILOMETERS_PER_DEGREE_AT_EQUATOR * cos(deg2rad($latitudeDegrees)));
    }

    public static function metersPerDegree(float $latitudeDegrees): float
    {
        return self::METERS_PER_DEGREE_AT_EQUATOR * cos(deg2rad($latitudeDegrees));
    }

    public static function kilometersPerDegree(float $latitudeDegrees): float
    {
        return self::KILOMETERS_PER_DEGREE_AT_EQUATOR * cos(deg2rad($latitudeDegrees));
    }

    public static function metersFromDegrees(float $degrees, float $latitudeDegrees): float
    {
        return $degrees * self::METERS_PER_DEGREE_AT_EQUATOR * cos(deg2rad($latitudeDegrees));
    }

    public static function kilometersFromDegrees(float $degrees, float $latitudeDegrees): float
    {
        return $degrees * self::KILOMETERS_PER_DEGREE_AT_EQUATOR * cos(deg2rad($latitudeDegrees));
    }
}
