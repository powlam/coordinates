<?php

declare(strict_types=1);

namespace Powlam\Coordinates;

use Powlam\Coordinates\Enums\Heading;
use Powlam\Coordinates\Enums\Units;
use Powlam\Coordinates\Helpers\FloatCompare;
use Powlam\Coordinates\Interfaces\KnowsPlaces;
use Powlam\Coordinates\Interfaces\Movable;
use Powlam\Coordinates\Traits\IsPlace;

/**
 * @internal
 */
final class LatLngAltitude implements \Stringable, KnowsPlaces, Movable
{
    use IsPlace;

    public const float EARTH_RADIUS = 6371000.0;

    private readonly LatLng $latLng;

    /**
     * @param  float  $altitude  The altitude in meters. Zero is sea level.
     */
    public function __construct(
        float $latitude,
        float $longitude,
        private float $altitude
    ) {
        $this->latLng = new LatLng($latitude, $longitude);
        $this->altitude = $this->limitedAltitude($this->altitude);
    }

    public function getLatitude(): float
    {
        return $this->latLng->getLatitude();
    }

    public function getLongitude(): float
    {
        return $this->latLng->getLongitude();
    }

    public function getAltitude(): float
    {
        return $this->altitude;
    }

    public function equals(self $other): bool
    {
        return
            $this->latLng->equals($other->latLng) &&
            FloatCompare::equals($this->altitude, $other->altitude);
    }

    public function __toString(): string
    {
        return sprintf('%f,%f,%f', $this->latLng->getLatitude(), $this->latLng->getLongitude(), $this->altitude);
    }

    /**
     * @return array{latitude: float, longitude: float, altitude: float}
     */
    public function toArray(): array
    {
        return [
            'latitude' => $this->latLng->getLatitude(),
            'longitude' => $this->latLng->getLongitude(),
            'altitude' => $this->altitude,
        ];
    }

    public function toUrlValue(int $precision = 6): string
    {
        return sprintf('%.'.$precision.'f,%.'.$precision.'f,%.'.$precision.'f', $this->latLng->getLatitude(), $this->latLng->getLongitude(), $this->altitude);
    }

    public function toJson(): string|false
    {
        return json_encode($this->toArray());
    }

    public function toGeoJson(): string|false
    {
        return json_encode([
            'type' => 'Point',
            'coordinates' => array_filter([
                $this->latLng->getLongitude(),
                $this->latLng->getLatitude(),
                FloatCompare::equals($this->altitude, 0.0) ? null : $this->altitude,
            ], fn ($value): bool => $value !== null),
        ]);
    }

    /**
     * @param  array{latitude: float, longitude: float, altitude: float}  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['latitude'],
            $data['longitude'],
            $data['altitude'],
        );
    }

    public function move(Heading $heading, float $distance, Units $units = Units::DEGREES): static
    {
        switch ($heading) {
            case Heading::UP:
            case Heading::DOWN:
                if ($units === Units::DEGREES) {
                    throw new \InvalidArgumentException('Cannot move up or down in degrees.');
                }
                if ($units === Units::KILOMETERS) {
                    $distance *= 1000.0;
                }

                return $this->moveInMetersVertically($heading, $distance);
            default:
                $this->latLng->move($heading, $distance, $units);

                return $this;
        }
    }

    private function moveInMetersVertically(Heading $heading, float $distance): static
    {
        switch ($heading) {
            case Heading::UP:
                $this->altitude += $distance;
                break;
            case Heading::DOWN:
                $this->altitude -= $distance;
                break;
        }

        $this->altitude = $this->limitedAltitude($this->altitude);

        return $this;
    }

    /**
     * Limits the minimum altitude to the radius of the Earth.
     */
    private function limitedAltitude(float $altitude): float
    {
        return max(-self::EARTH_RADIUS, $altitude);
    }
}
