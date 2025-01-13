<?php

declare(strict_types=1);

namespace Powlam\Coordinates;

use Powlam\Coordinates\Enums\Heading;
use Powlam\Coordinates\Enums\Units;
use Powlam\Coordinates\Interfaces\KnowsPlaces;
use Powlam\Coordinates\Interfaces\Movable;
use Powlam\Coordinates\Traits\IsPlace;
use Powlam\Coordinates\Utils\FloatCompare;
use Powlam\Coordinates\Utils\Longitude;

/**
 * @internal
 */
final class LatLngBounds implements \Stringable, KnowsPlaces, Movable
{
    use IsPlace;

    private bool $includes180thMeridian = false;

    public function __construct(
        private LatLng $southwest,
        private LatLng $northeast
    ) {
        if (FloatCompare::greaterThan($this->getSouth(), $this->getNorth())) {
            throw new \InvalidArgumentException('The southwest corner must be south of the northeast corner.');
        }
        $this->includes180thMeridian =
            FloatCompare::lessThan($this->getEast(), $this->getWest()) ||
            FloatCompare::equals(abs($this->getEast()), 180.0) ||
            FloatCompare::equals(abs($this->getWest()), 180.0);
    }

    public function getSouthwest(): LatLng
    {
        return $this->southwest;
    }

    public function getNortheast(): LatLng
    {
        return $this->northeast;
    }

    public function getSouthEast(): LatLng
    {
        return new LatLng($this->getSouth(), $this->getEast());
    }

    public function getNorthWest(): LatLng
    {
        return new LatLng($this->getNorth(), $this->getWest());
    }

    public function getNorth(): float
    {
        return $this->northeast->getLatitude();
    }

    public function getSouth(): float
    {
        return $this->southwest->getLatitude();
    }

    public function getEast(): float
    {
        return $this->northeast->getLongitude();
    }

    public function getWest(): float
    {
        return $this->southwest->getLongitude();
    }

    public function includes180thMeridian(): bool
    {
        return $this->includes180thMeridian;
    }

    public function includes0thMeridian(): bool
    {
        return
            FloatCompare::equalOrLessThan($this->getWest(), 0.0) &&
            FloatCompare::equalOrGreaterThan($this->getEast(), 0.0);
    }

    public function includesNthMeridian(float $n): bool
    {
        return
            FloatCompare::equalOrLessThan($this->getWest(), $n) &&
            FloatCompare::equalOrGreaterThan($this->getEast(), $n);
    }

    public function includesAPole(): bool
    {
        if (FloatCompare::equalOrLessThan($this->getSouth(), -90.0)) {
            return true;
        }

        return FloatCompare::equalOrGreaterThan($this->getNorth(), 90.0);
    }

    public function includesBothPoles(): bool
    {
        return
            FloatCompare::equalOrLessThan($this->getSouth(), -90.0) &&
            FloatCompare::equalOrGreaterThan($this->getNorth(), 90.0);
    }

    public function includesNorthPole(): bool
    {
        return FloatCompare::equalOrGreaterThan($this->getNorth(), 90.0);
    }

    public function includesSouthPole(): bool
    {
        return FloatCompare::equalOrLessThan($this->getSouth(), -90.0);
    }

    public function includesEquator(): bool
    {
        return
            FloatCompare::equalOrLessThan($this->getSouth(), 0.0) &&
            FloatCompare::equalOrGreaterThan($this->getNorth(), 0.0);
    }

    public function isLine(): bool
    {
        if (FloatCompare::equals($this->getSouth(), $this->getNorth())) {
            return true;
        }

        return FloatCompare::equals($this->getWest(), $this->getEast());
    }

    public function isMeridian(): bool
    {
        return FloatCompare::equals($this->getWest(), $this->getEast());
    }

    public function isParallel(): bool
    {
        return FloatCompare::equals($this->getSouth(), $this->getNorth());
    }

    public function isPoint(): bool
    {
        return
            FloatCompare::equals($this->getSouth(), $this->getNorth()) &&
            FloatCompare::equals($this->getWest(), $this->getEast());
    }

    public function getCenter(): LatLng
    {
        $lat = ($this->getSouth() + $this->getNorth()) / 2.0;
        $lng = ($this->getWest() + $this->getEast()) / 2.0;

        if ($this->includes180thMeridian) {
            $lng += 180.0;
        }

        return new LatLng($lat, $lng);
    }

    public function equals(self $other): bool
    {
        return
            $this->southwest->equals($other->southwest) &&
            $this->northeast->equals($other->northeast);
    }

    public function __toString(): string
    {
        return $this->southwest.'|'.$this->northeast;
    }

    /**
     * @return array{southwest: array{latitude: float, longitude: float}, northeast: array{latitude: float, longitude: float}}
     */
    public function toArray(): array
    {
        return [
            'southwest' => $this->southwest->toArray(),
            'northeast' => $this->northeast->toArray(),
        ];
    }

    /**
     * @return array{latitude: float, longitude: float}
     */
    public function toSpan(): array
    {
        $lat = $this->getNorth() - $this->getSouth();

        $lng = fmod(($this->getEast() - $this->getWest() + 360.0), 360.0);
        if (FloatCompare::equals($lng, 0.0)) {
            $lng = 360.0;
        }

        return ['latitude' => $lat, 'longitude' => $lng];
    }

    public function toUrlValue(int $precision = 6): string
    {
        return $this->southwest->toUrlValue($precision).'|'.$this->northeast->toUrlValue($precision);
    }

    public function toJson(): string|false
    {
        return json_encode($this->toArray());
    }

    public function toGeoJson(): string|false
    {
        return json_encode([
            'type' => 'Polygon',
            'coordinates' => [
                [
                    [$this->getWest(), $this->getSouth()],
                    [$this->getEast(), $this->getSouth()],
                    [$this->getEast(), $this->getNorth()],
                    [$this->getWest(), $this->getNorth()],
                    [$this->getWest(), $this->getSouth()],
                ],
            ],
        ]);
    }

    /**
     * @param  array{latitude: float, longitude: float}  $southwest
     * @param  array{latitude: float, longitude: float}  $northeast
     */
    public static function fromArrays(array $southwest, array $northeast): static
    {
        return new self(
            LatLng::fromArray($southwest),
            LatLng::fromArray($northeast),
        );
    }

    public function move(Heading $heading, float $distance, Units $units = Units::DEGREES): static
    {
        // if moving towards east or west and using (kilo)meters, the corresponding degrees will be calculated based on the midpoint latitude of the area
        if (in_array($heading, [Heading::EAST, Heading::WEST], true) && in_array($units, [Units::METERS, Units::KILOMETERS], true)) {
            $midpointLatitude = ($this->getSouth() + $this->getNorth()) / 2.0;
            if ($units === Units::METERS) {
                $distance = Longitude::degreesFromMeters($distance, $midpointLatitude);
            } else {
                $distance = Longitude::degreesFromKilometers($distance, $midpointLatitude);
            }
            $units = Units::DEGREES;
        }

        $this->southwest->move($heading, $distance, $units);
        $this->northeast->move($heading, $distance, $units);

        return $this;
    }

    public function contains(LatLng $latLng): bool
    {
        $lat = $latLng->getLatitude();
        $lng = $latLng->getLongitude();

        if ($this->includes180thMeridian) {
            return
                FloatCompare::equalOrLessThan($this->getSouth(), $lat) &&
                FloatCompare::equalOrLessThan($lat, $this->getNorth()) &&
                (
                    FloatCompare::equalOrLessThan($this->getWest(), $lng) ||
                    FloatCompare::equalOrGreaterThan($this->getEast(), $lng)
                );
        }

        return
            FloatCompare::equalOrLessThan($this->getSouth(), $lat) &&
            FloatCompare::equalOrLessThan($lat, $this->getNorth()) &&
            FloatCompare::equalOrLessThan($this->getWest(), $lng) &&
            FloatCompare::equalOrLessThan($lng, $this->getEast());
    }

    public function intersects(LatLngBounds $bounds): bool
    {
        if ($this->contains($bounds->getSouthwest())) {
            return true;
        }
        if ($this->contains($bounds->getNortheast())) {
            return true;
        }
        if ($this->contains($bounds->getSouthEast())) {
            return true;
        }
        if ($this->contains($bounds->getNorthWest())) {
            return true;
        }
        if ($bounds->contains($this->southwest)) {
            return true;
        }

        return $bounds->contains($this->northeast);
    }

    /**
     * Extends this bounds to contain the given point.
     * The extension will head west or east depending on the closest side, or east in case of a tie.
     */
    public function extend(LatLng $point): static
    {
        if ($this->contains($point)) {
            return $this;
        }

        $lat = $point->getLatitude();
        $lng = $point->getLongitude();

        $swLat = min($this->getSouth(), $lat);
        $neLat = max($this->getNorth(), $lat);
        $swLng = $this->getWest();
        $neLng = $this->getEast();

        $extendedInLatitude = new LatLngBounds(
            new LatLng($swLat, $swLng),
            new LatLng($neLat, $neLng)
        );

        if ($extendedInLatitude->contains($point)) {
            $this->southwest = $extendedInLatitude->getSouthwest();
            $this->northeast = $extendedInLatitude->getNortheast();

            return $this;
        }

        if ($this->pointIsClosestTowardsEast($lng, $swLng, $neLng)) {
            $neLng = $lng;
        } else {
            $swLng = $lng;
        }

        $this->southwest = new LatLng($swLat, $swLng);
        $this->northeast = new LatLng($neLat, $neLng);

        return $this;
    }

    public function union(LatLngBounds $bounds): static
    {
        if ($this->contains($bounds->getSouthwest()) && $this->contains($bounds->getNortheast())) {
            // there are two possibilities: this bounds contains the other bounds or their union is the full world
            // if the west of this bounds is closer to the east of the other bounds than to the west of the other bounds, then the union is the full world
            if (FloatCompare::lessThan(
                $this->absoluteDistance($bounds->getEast(), $this->getWest()),
                $this->absoluteDistance($bounds->getWest(), $this->getWest())
            )) {
                return new LatLngBounds(
                    new LatLng($this->getSouth(), -180.0),
                    new LatLng($this->getNorth(), 180.0)
                );
            }

            return $this;
        }

        if ($bounds->contains($this->southwest) && $bounds->contains($this->northeast)) {
            return $bounds;
        }

        $unionSouth = min($this->getSouth(), $bounds->getSouth());
        $unionNorth = max($this->getNorth(), $bounds->getNorth());
        $unionWest = $this->getWest();
        $unionEast = $this->getEast();

        $extendedInLatitude = new LatLngBounds(
            new LatLng($unionSouth, $unionWest),
            new LatLng($unionNorth, $unionEast)
        );

        $thisContainsWestSide = $extendedInLatitude->contains($bounds->getSouthwest());
        $thisContainsEastSide = $extendedInLatitude->contains($bounds->getNortheast());

        if ($thisContainsWestSide && $thisContainsEastSide) {
            return $extendedInLatitude;
        }

        if ($thisContainsWestSide) {
            $unionEast = $bounds->getEast();
        } elseif ($thisContainsEastSide) {
            $unionWest = $bounds->getWest();
        } elseif ($extendedInLatitude->intersects($bounds)) {
            $unionWest = $bounds->getWest();
            $unionEast = $bounds->getEast();
        } elseif ($this->boundsAreClosestTowardsEast($bounds->getWest(), $bounds->getEast(), $unionWest, $unionEast)) {
            $unionEast = $bounds->getEast();
        } else {
            $unionWest = $bounds->getWest();
        }

        return new LatLngBounds(
            new LatLng($unionSouth, $unionWest),
            new LatLng($unionNorth, $unionEast)
        );
    }

    private function pointIsClosestTowardsEast(float $targetLng, float $thisWest, float $thisEast): bool
    {
        $distanceTowardsEast = $this->absoluteDistance($targetLng, $thisEast);
        $distanceTowardsWest = $this->absoluteDistance($targetLng, $thisWest);

        return FloatCompare::equalOrLessThan($distanceTowardsEast, $distanceTowardsWest);
    }

    private function boundsAreClosestTowardsEast(float $targetWest, float $targetEast, float $thisWest, float $thisEast): bool
    {
        $distanceTowardsEast = $this->absoluteDistance($targetWest, $thisEast);
        $distanceTowardsWest = $this->absoluteDistance($targetEast, $thisWest);

        return FloatCompare::equalOrLessThan($distanceTowardsEast, $distanceTowardsWest);
    }

    private function absoluteDistance(float $lng1, float $lng2): float
    {
        return FloatCompare::equalOrLessThan($lng1, $lng2)
            ? min(abs($lng1 - $lng2), abs(360.0 + $lng1 - $lng2))
            : min(abs($lng2 - $lng1), abs(360.0 + $lng2 - $lng1));
    }
}
