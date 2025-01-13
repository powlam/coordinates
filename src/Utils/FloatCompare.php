<?php

namespace Powlam\Coordinates\Utils;

class FloatCompare
{
    public const float COMPARISON_TOLERANCE = 0.000001;

    public static function equals(float $a, float $b): bool
    {
        return abs($a - $b) < self::COMPARISON_TOLERANCE;
    }

    public static function equalOrGreaterThan(float $a, float $b): bool
    {
        return $a > $b || self::equals($a, $b);
    }

    public static function equalOrLessThan(float $a, float $b): bool
    {
        return $a < $b || self::equals($a, $b);
    }

    public static function greaterThan(float $a, float $b): bool
    {
        return $a > $b && ! self::equals($a, $b);
    }

    public static function lessThan(float $a, float $b): bool
    {
        return $a < $b && ! self::equals($a, $b);
    }
}
