<?php

declare(strict_types=1);

namespace Powlam\Coordinates;

use Powlam\Coordinates\Enums\Heading;
use Powlam\Coordinates\Enums\Units;
use Powlam\Coordinates\Helpers\FloatCompare;
use Powlam\Coordinates\Interfaces\KnowsPlaces;
use Powlam\Coordinates\Interfaces\Moveable;
use Powlam\Coordinates\Traits\IsPlace;

/**
 * @internal
 */
final class LatLng implements \Stringable, KnowsPlaces, Moveable
{
    use IsPlace;

    public function __construct(
        private float $latitude,
        private float $longitude
    ) {
        $this->latitude = $this->limitedLatitude($this->latitude);
        $this->longitude = $this->normalizedLongitude($this->longitude);
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function equals(self $other): bool
    {
        return
            FloatCompare::equals($this->latitude, $other->latitude) &&
            FloatCompare::equals($this->longitude, $other->longitude);
    }

    public function __toString(): string
    {
        return sprintf('%f,%f', $this->latitude, $this->longitude);
    }

    /**
     * @return array{latitude: float, longitude: float}
     */
    public function toArray(): array
    {
        return [
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }

    public function toUrlValue(int $precision = 6): string
    {
        return sprintf('%.'.$precision.'f,%.'.$precision.'f', $this->latitude, $this->longitude);
    }

    public function toJson(): string|false
    {
        return json_encode($this->toArray());
    }

    public function toGeoJson(): string|false
    {
        return json_encode([
            'type' => 'Point',
            'coordinates' => [
                $this->longitude,
                $this->latitude,
            ],
        ]);
    }

    /**
     * @param  array{latitude: float, longitude: float}  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['latitude'],
            $data['longitude'],
        );
    }

    public function move(Heading $heading, float $distance, Units $units = Units::DEGREES): static
    {
        switch ($units) {
            case Units::METERS:
                return $this->moveInMeters($heading, $distance);
            case Units::KILOMETERS:
                return $this->moveInMeters($heading, $distance * 1000.0);
            case Units::DEGREES:
            default:
                return $this->moveInDegrees($heading, $distance);
        }
    }

    private function moveInDegrees(Heading $heading, float $distance): static
    {
        switch ($heading) {
            case Heading::NORTH:
                $this->latitude += $distance;
                break;
            case Heading::SOUTH:
                $this->latitude -= $distance;
                break;
            case Heading::EAST:
                $this->longitude += $distance;
                break;
            case Heading::WEST:
                $this->longitude -= $distance;
                break;
            default:
                throw new \InvalidArgumentException('Invalid heading');
        }

        $this->latitude = $this->limitedLatitude($this->latitude);
        $this->longitude = $this->normalizedLongitude($this->longitude);

        return $this;
    }

    private function moveInMeters(Heading $heading, float $distance): static
    {
        if ($heading === Heading::NORTH || $heading === Heading::SOUTH) {
            $distanceInDegrees = $distance / 111319.9;
        } else {
            $distanceInDegrees = $distance / (111319.9 * cos(deg2rad($this->latitude)));
        }

        return $this->moveInDegrees($heading, $distanceInDegrees);
    }

    /**
     * Limits latitude to the range -90 to 90
     */
    private function limitedLatitude(float $latitude): float
    {
        return max(-90.0, min(90.0, $latitude));
    }

    /**
     * Normalizes longitude to the range -180 to 180
     */
    private function normalizedLongitude(float $longitude): float
    {
        if (FloatCompare::lessThan($longitude, -180.0)) {
            return fmod($longitude, 360.0) + 360.0;
        }

        if (FloatCompare::greaterThan($longitude, 180.0)) {
            return fmod($longitude, 360.0) - 360.0;
        }

        return $longitude;
    }
}
