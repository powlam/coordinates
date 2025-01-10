<?php

declare(strict_types=1);

namespace Powlam\Coordinates;

/**
 * @internal
 */
final class LatLng implements \Stringable
{
    public function __construct(
        private float $latitude,
        private float $longitude
    ) {
        // limit latitude to the range -90 to 90
        $this->latitude = max(-90.0, min(90.0, $this->latitude));

        // normalize longitude to the range -180 to 180
        if ($this->longitude < -180.0) {
            $this->longitude = fmod($this->longitude, 360.0) + 360.0;
        } elseif ($this->longitude > 180.0) {
            $this->longitude = fmod($this->longitude, 360.0) - 360.0;
        }
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
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
}
