<?php

declare(strict_types=1);

namespace Powlam\Coordinates;

/**
 * @internal
 */
final readonly class LatLngAltitude implements \Stringable
{
    private LatLng $latLng;

    public function __construct(
        float $latitude,
        float $longitude,
        private float $altitude
    ) {
        $this->latLng = new LatLng($latitude, $longitude);
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
                $this->altitude === 0.0 ? null : $this->altitude,
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
}
