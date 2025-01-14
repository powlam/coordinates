<p align="center">
    <img src="https://raw.githubusercontent.com/powlam/coordinates/main/docs/coordinatesLogo.png" alt="Coordinates for Php">
    <p align="center">
        <a href="https://github.com/powlam/coordinates/actions"><img alt="GitHub Workflow Status (master)" src="https://img.shields.io/github/actions/workflow/status/powlam/coordinates/tests.yml"></a>
        <a href="https://packagist.org/packages/powlam/coordinates"><img alt="Total Downloads" src="https://img.shields.io/packagist/dt/powlam/coordinates"></a>
        <a href="https://packagist.org/packages/powlam/coordinates"><img alt="Latest Version" src="https://img.shields.io/packagist/v/powlam/coordinates"></a>
        <a href="https://packagist.org/packages/powlam/coordinates"><img alt="License" src="https://img.shields.io/packagist/l/powlam/coordinates"></a>
    </p>
</p>

------

## Enum: Powlam\Coordinates\Enums\Heading

#### Values

* `NORTH`
* `SOUTH`
* `EAST`
* `WEST`
* `UP`
* `DOWN`



------

## Enum: Powlam\Coordinates\Enums\Place

#### Values

* `EARTH_CENTER`
* `NORTH_POLE`
* `NORTHERN_HEMISPHERE`
* `EQUATOR`
* `SOUTHERN_HEMISPHERE`
* `SOUTH_POLE`
* `ARCTIC`
* `ARCTIC_CIRCLE`
* `NORTH_TEMPERATE_ZONE`
* `TROPIC_OF_CANCER`
* `TROPICS`
* `TROPIC_OF_CAPRICORN`
* `SOUTH_TEMPERATE_ZONE`
* `ANTARCTIC_CIRCLE`
* `ANTARCTIC`
* `PRIME_MERIDIAN`
* `INTERNATIONAL_DATE_LINE`
* `WESTERN_HEMISPHERE`
* `EASTERN_HEMISPHERE`

### Method: name

```php
Powlam\Coordinates\Enums\Place::name(): string
```

### Method: get

```php
Powlam\Coordinates\Enums\Place::get(): Powlam\Coordinates\LatLng|Powlam\Coordinates\LatLngAltitude|Powlam\Coordinates\LatLngBounds
```



------

## Enum: Powlam\Coordinates\Enums\Units

#### Values

* `DEGREES`
* `METERS`
* `KILOMETERS`



------

## Interface: Powlam\Coordinates\Interfaces\KnowsPlaces

### Method: isPlace

```php
Powlam\Coordinates\Interfaces\KnowsPlaces::isPlace(Powlam\Coordinates\Enums\Place $place): bool
```



------

## Interface: Powlam\Coordinates\Interfaces\Movable

### Method: move

```php
Powlam\Coordinates\Interfaces\Movable::move(Powlam\Coordinates\Enums\Heading $heading, float $distance, Powlam\Coordinates\Enums\Units $units = \Powlam\Coordinates\Enums\Units::DEGREES): static
```



------

## Class: Powlam\Coordinates\LatLng

```php
/**
 * @internal
 */
```

#### Implements

* Stringable
* Powlam\Coordinates\Interfaces\KnowsPlaces
* Powlam\Coordinates\Interfaces\Movable

#### Uses Traits

* Powlam\Coordinates\Traits\IsPlace

### Method: __construct

```php
Powlam\Coordinates\LatLng::__construct(float $latitude, float $longitude)
```

### Method: getLatitude

```php
Powlam\Coordinates\LatLng::getLatitude(): float
```

### Method: getLongitude

```php
Powlam\Coordinates\LatLng::getLongitude(): float
```

### Method: equals

```php
Powlam\Coordinates\LatLng::equals(self $other): bool
```

### Method: __toString

```php
Powlam\Coordinates\LatLng::__toString(): string
```

### Method: toArray

```php
/**
 * @return array{latitude: float, longitude: float}
 */
Powlam\Coordinates\LatLng::toArray(): array
```

### Method: toUrlValue

```php
Powlam\Coordinates\LatLng::toUrlValue(int $precision = 6): string
```

### Method: toJson

```php
Powlam\Coordinates\LatLng::toJson(): string|false
```

### Method: toGeoJson

```php
Powlam\Coordinates\LatLng::toGeoJson(): string|false
```

### Method: fromArray

```php
/**
 * @param  array{latitude: float, longitude: float}  $data
 */
Powlam\Coordinates\LatLng::fromArray(array $data): self
```

### Method: move

```php
Powlam\Coordinates\LatLng::move(Powlam\Coordinates\Enums\Heading $heading, float $distance, Powlam\Coordinates\Enums\Units $units = \Powlam\Coordinates\Enums\Units::DEGREES): static
```

### Method: isPlace

```php
Powlam\Coordinates\LatLng::isPlace(Powlam\Coordinates\Enums\Place $place): bool
```



------

## Class: Powlam\Coordinates\LatLngAltitude

```php
/**
 * @internal
 */
```

#### Implements

* Stringable
* Powlam\Coordinates\Interfaces\KnowsPlaces
* Powlam\Coordinates\Interfaces\Movable

#### Uses Traits

* Powlam\Coordinates\Traits\IsPlace

#### Constants

* `EARTH_RADIUS` = 6371000.0

### Method: __construct

```php
/**
 * @param  float  $altitude  The altitude in meters. Zero is sea level.
 */
Powlam\Coordinates\LatLngAltitude::__construct(float $latitude, float $longitude, float $altitude)
```

### Method: getLatitude

```php
Powlam\Coordinates\LatLngAltitude::getLatitude(): float
```

### Method: getLongitude

```php
Powlam\Coordinates\LatLngAltitude::getLongitude(): float
```

### Method: getAltitude

```php
Powlam\Coordinates\LatLngAltitude::getAltitude(): float
```

### Method: equals

```php
Powlam\Coordinates\LatLngAltitude::equals(self $other): bool
```

### Method: __toString

```php
Powlam\Coordinates\LatLngAltitude::__toString(): string
```

### Method: toArray

```php
/**
 * @return array{latitude: float, longitude: float, altitude: float}
 */
Powlam\Coordinates\LatLngAltitude::toArray(): array
```

### Method: toUrlValue

```php
Powlam\Coordinates\LatLngAltitude::toUrlValue(int $precision = 6): string
```

### Method: toJson

```php
Powlam\Coordinates\LatLngAltitude::toJson(): string|false
```

### Method: toGeoJson

```php
Powlam\Coordinates\LatLngAltitude::toGeoJson(): string|false
```

### Method: fromArray

```php
/**
 * @param  array{latitude: float, longitude: float, altitude: float}  $data
 */
Powlam\Coordinates\LatLngAltitude::fromArray(array $data): self
```

### Method: move

```php
Powlam\Coordinates\LatLngAltitude::move(Powlam\Coordinates\Enums\Heading $heading, float $distance, Powlam\Coordinates\Enums\Units $units = \Powlam\Coordinates\Enums\Units::DEGREES): static
```

### Method: isPlace

```php
Powlam\Coordinates\LatLngAltitude::isPlace(Powlam\Coordinates\Enums\Place $place): bool
```



------

## Class: Powlam\Coordinates\LatLngBounds

```php
/**
 * @internal
 */
```

#### Implements

* Stringable
* Powlam\Coordinates\Interfaces\KnowsPlaces
* Powlam\Coordinates\Interfaces\Movable

#### Uses Traits

* Powlam\Coordinates\Traits\IsPlace

### Method: __construct

```php
Powlam\Coordinates\LatLngBounds::__construct(Powlam\Coordinates\LatLng $southwest, Powlam\Coordinates\LatLng $northeast)
```

### Method: getSouthwest

```php
Powlam\Coordinates\LatLngBounds::getSouthwest(): Powlam\Coordinates\LatLng
```

### Method: getNortheast

```php
Powlam\Coordinates\LatLngBounds::getNortheast(): Powlam\Coordinates\LatLng
```

### Method: getSouthEast

```php
Powlam\Coordinates\LatLngBounds::getSouthEast(): Powlam\Coordinates\LatLng
```

### Method: getNorthWest

```php
Powlam\Coordinates\LatLngBounds::getNorthWest(): Powlam\Coordinates\LatLng
```

### Method: getNorth

```php
Powlam\Coordinates\LatLngBounds::getNorth(): float
```

### Method: getSouth

```php
Powlam\Coordinates\LatLngBounds::getSouth(): float
```

### Method: getEast

```php
Powlam\Coordinates\LatLngBounds::getEast(): float
```

### Method: getWest

```php
Powlam\Coordinates\LatLngBounds::getWest(): float
```

### Method: includes180thMeridian

```php
Powlam\Coordinates\LatLngBounds::includes180thMeridian(): bool
```

### Method: includes0thMeridian

```php
Powlam\Coordinates\LatLngBounds::includes0thMeridian(): bool
```

### Method: includesNthMeridian

```php
Powlam\Coordinates\LatLngBounds::includesNthMeridian(float $n): bool
```

### Method: includesAPole

```php
Powlam\Coordinates\LatLngBounds::includesAPole(): bool
```

### Method: includesBothPoles

```php
Powlam\Coordinates\LatLngBounds::includesBothPoles(): bool
```

### Method: includesNorthPole

```php
Powlam\Coordinates\LatLngBounds::includesNorthPole(): bool
```

### Method: includesSouthPole

```php
Powlam\Coordinates\LatLngBounds::includesSouthPole(): bool
```

### Method: includesEquator

```php
Powlam\Coordinates\LatLngBounds::includesEquator(): bool
```

### Method: isLine

```php
Powlam\Coordinates\LatLngBounds::isLine(): bool
```

### Method: isMeridian

```php
Powlam\Coordinates\LatLngBounds::isMeridian(): bool
```

### Method: isParallel

```php
Powlam\Coordinates\LatLngBounds::isParallel(): bool
```

### Method: isPoint

```php
Powlam\Coordinates\LatLngBounds::isPoint(): bool
```

### Method: getCenter

```php
Powlam\Coordinates\LatLngBounds::getCenter(): Powlam\Coordinates\LatLng
```

### Method: equals

```php
Powlam\Coordinates\LatLngBounds::equals(self $other): bool
```

### Method: __toString

```php
Powlam\Coordinates\LatLngBounds::__toString(): string
```

### Method: toArray

```php
/**
 * @return array{southwest: array{latitude: float, longitude: float}, northeast: array{latitude: float, longitude: float}}
 */
Powlam\Coordinates\LatLngBounds::toArray(): array
```

### Method: toSpan

```php
/**
 * @return array{latitude: float, longitude: float}
 */
Powlam\Coordinates\LatLngBounds::toSpan(): array
```

### Method: toUrlValue

```php
Powlam\Coordinates\LatLngBounds::toUrlValue(int $precision = 6): string
```

### Method: toJson

```php
Powlam\Coordinates\LatLngBounds::toJson(): string|false
```

### Method: toGeoJson

```php
Powlam\Coordinates\LatLngBounds::toGeoJson(): string|false
```

### Method: fromArrays

```php
/**
 * @param  array{latitude: float, longitude: float}  $southwest
 * @param  array{latitude: float, longitude: float}  $northeast
 */
Powlam\Coordinates\LatLngBounds::fromArrays(array $southwest, array $northeast): static
```

### Method: move

```php
Powlam\Coordinates\LatLngBounds::move(Powlam\Coordinates\Enums\Heading $heading, float $distance, Powlam\Coordinates\Enums\Units $units = \Powlam\Coordinates\Enums\Units::DEGREES): static
```

### Method: contains

```php
Powlam\Coordinates\LatLngBounds::contains(Powlam\Coordinates\LatLng $latLng): bool
```

### Method: intersects

```php
Powlam\Coordinates\LatLngBounds::intersects(Powlam\Coordinates\LatLngBounds $bounds): bool
```

### Method: extend

```php
/**
 * Extends this bounds to contain the given point.
 * The extension will head west or east depending on the closest side, or east in case of a tie.
 */
Powlam\Coordinates\LatLngBounds::extend(Powlam\Coordinates\LatLng $point): static
```

### Method: union

```php
Powlam\Coordinates\LatLngBounds::union(Powlam\Coordinates\LatLngBounds $bounds): static
```

### Method: isPlace

```php
Powlam\Coordinates\LatLngBounds::isPlace(Powlam\Coordinates\Enums\Place $place): bool
```



------

## Trait: Powlam\Coordinates\Traits\IsPlace

### Method: isPlace

```php
Powlam\Coordinates\Traits\IsPlace::isPlace(Powlam\Coordinates\Enums\Place $place): bool
```



------

## Class: Powlam\Coordinates\Utils\FloatCompare

#### Constants

* `COMPARISON_TOLERANCE` = 1.0E-6

### Method: equals

```php
Powlam\Coordinates\Utils\FloatCompare::equals(float $a, float $b): bool
```

### Method: equalOrGreaterThan

```php
Powlam\Coordinates\Utils\FloatCompare::equalOrGreaterThan(float $a, float $b): bool
```

### Method: equalOrLessThan

```php
Powlam\Coordinates\Utils\FloatCompare::equalOrLessThan(float $a, float $b): bool
```

### Method: greaterThan

```php
Powlam\Coordinates\Utils\FloatCompare::greaterThan(float $a, float $b): bool
```

### Method: lessThan

```php
Powlam\Coordinates\Utils\FloatCompare::lessThan(float $a, float $b): bool
```



------

## Class: Powlam\Coordinates\Utils\Latitude

#### Constants

* `METERS_PER_DEGREE` = 111319.9
* `KILOMETERS_PER_DEGREE` = 111.3199

### Method: degreesFromMeters

```php
Powlam\Coordinates\Utils\Latitude::degreesFromMeters(float $meters): float
```

### Method: degreesFromKilometers

```php
Powlam\Coordinates\Utils\Latitude::degreesFromKilometers(float $kilometers): float
```

### Method: metersPerDegree

```php
Powlam\Coordinates\Utils\Latitude::metersPerDegree(): float
```

### Method: kilometersPerDegree

```php
Powlam\Coordinates\Utils\Latitude::kilometersPerDegree(): float
```

### Method: metersFromDegrees

```php
Powlam\Coordinates\Utils\Latitude::metersFromDegrees(float $degrees): float
```

### Method: kilometersFromDegrees

```php
Powlam\Coordinates\Utils\Latitude::kilometersFromDegrees(float $degrees): float
```



------

## Class: Powlam\Coordinates\Utils\Longitude

#### Constants

* `METERS_PER_DEGREE_AT_EQUATOR` = 111319.9
* `KILOMETERS_PER_DEGREE_AT_EQUATOR` = 111.3199

### Method: degreesFromMeters

```php
Powlam\Coordinates\Utils\Longitude::degreesFromMeters(float $meters, float $latitudeDegrees): float
```

### Method: degreesFromKilometers

```php
Powlam\Coordinates\Utils\Longitude::degreesFromKilometers(float $kilometers, float $latitudeDegrees): float
```

### Method: metersPerDegree

```php
Powlam\Coordinates\Utils\Longitude::metersPerDegree(float $latitudeDegrees): float
```

### Method: kilometersPerDegree

```php
Powlam\Coordinates\Utils\Longitude::kilometersPerDegree(float $latitudeDegrees): float
```

### Method: metersFromDegrees

```php
Powlam\Coordinates\Utils\Longitude::metersFromDegrees(float $degrees, float $latitudeDegrees): float
```

### Method: kilometersFromDegrees

```php
Powlam\Coordinates\Utils\Longitude::kilometersFromDegrees(float $degrees, float $latitudeDegrees): float
```

------

**Coordinates for PHP** was created by **[Paul Albandoz](https://github.com/powlam)** under the **[MIT license](https://opensource.org/licenses/MIT)**.