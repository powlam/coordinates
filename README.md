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
This package provides a handful of tools to work with **coordinates** the same way as [Google Maps Javascript API](https://developers.google.com/maps/documentation/javascript/reference/coordinates?hl=es-419) does.

> **Requires [PHP 8.3+](https://php.net/releases/)**

> Note: This is still a work in progress...

# Classes

## LatLng class

A LatLng is a point in geographic coordinates: latitude and longitude. Both parameters are of float type.

* **Latitude** ranges between -90 and 90 degrees inclusive. Values above or below this range will be clamped to the range [-90, 90]. This means that if the specified value is less than -90, it will be set to -90. And if the value is greater than 90, it will be set to 90.
* **Longitude** ranges between -180 and 180 degrees inclusive. Values above or below this range will be adjusted to fit within the range. For example, a value of -190 will become 170. A value of 190 will become -170. This reflects the fact that longitudes wrap around the globe.

## LatLngAltitude class

A LatLngAltitude is a 3D point in geographic coordinates: latitude, longitude, and altitude.

* **Altitude** is measured in meters. Positive values indicate heights above ground level, and negative values indicate depths below the ground surface.

## LatLngBounds class

A LatLngBounds instance represents a rectangle in geographical coordinates, including one that crosses the 180-degree longitudinal meridian.

# Features

## Movement

Both **LatLng** and **LatLngAltitude** points are movable, so they can be moved in any direction using the **move** method.

```php
use Powlam\Coordinates\Enums\Heading;
use Powlam\Coordinates\Enums\Units;
use Powlam\Coordinates\LatLngAltitude;

$latLngAlt = (new LatLngAltitude(1.23, 4.56, 0.0))
    ->move(Heading::NORTH, 10.0)
    ->move(Heading::SOUTH, 1.0)
    ->move(Heading::EAST, 20.0)
    ->move(Heading::WEST, 5.0)
    ->move(Heading::UP, 100.0, Units::METERS)
    ->move(Heading::DOWN, 30.0, Units::METERS);

// at this point $latLngAlt is at (10.23, 19.56, 70.0)
```

Note: Latitude movements stop when reaching the North or South Pole.

### Moving areas

The **LatLngBounds** rectangles are also movable; the entire area is moved at once.

When moving a **LatLngBounds** rectangle towards east or west using meters or kilometers, the conversion between distance and degrees depends on the latitude. The corresponding degrees will be calculated based on the midpoint latitude of the area.

## Interaction between bounds

**LatLngBounds** classes can interact with each other:

```php
use Powlam\Coordinates\LatLng;
use Powlam\Coordinates\LatLngBounds;

$bounds = new LatLngBounds(new LatLng(1, 1), new LatLng(10, 10));
// $bounds refers to (1, 1|10, 10)

$bounds->intersects(new LatLngBounds(new LatLng(5, 5), new LatLng(15, 15))); // returns true
$bounds->intersects(new LatLngBounds(new LatLng(15, 15), new LatLng(20, 20))); // returns false

$union = $bounds->union(new LatLngBounds(new LatLng(5, 6), new LatLng(15, 16)));
// $union refers to (1, 1|15, 16)
```

Also a **LatLngBounds** can interact with a **LatLng** point:

```php
use Powlam\Coordinates\LatLng;
use Powlam\Coordinates\LatLngBounds;

$bounds = new LatLngBounds(new LatLng(1, 1), new LatLng(10, 10));
// $bounds refers to (1, 1|10, 10)

$bounds->contains(new LatLng(5, 5)); // returns true
$bounds->contains(new LatLng(-5, 5)); // returns false

$bounds->extend(new LatLng(15, 16));
// at this point $bounds has been extended to (1, 1|15, 16)
```

Unions and extensions are always done in **the closest way possible**. When talking about the **longitude**, usually there are 2 ways of making the join: towards west or towards east. This library selects the closest one or, in case of a tie, towards east.

# Places

There is a list of geographical points, lines and areas into the **Place** enum.

Through the **get()** method you can retrieve the underlying **LatLng**, **LatLngAltitude** or **LatLngBounds** object that represents it.

Each of them can be used as any other **LatLng**, **LatLngAltitude** or **LatLngBounds** object.

```php
use Powlam\Coordinates\Enums\Place;

$northernHemisphere = Place::NORTHERN_HEMISPHERE->get();

$northernHemisphere->contains(new LatLng(5, 5)); // returns true
```

# Utils

## Latitude and Longitude

These classes facilitate converting between degrees (the units used in this project) and meters or kilometers in both directions.

This is especially useful in the case of longitudes, because the ratio changes depending on the latitude.

```php
use Powlam\Coordinates\Utils\Latitude;
use Powlam\Coordinates\Utils\Longitude;

Latitude::metersPerDegree(); // returns 111319.9
Latitude::degreesFromKilometers(Latitude::KILOMETERS_PER_DEGREE); // returns 1.0

Longitude::metersPerDegree(latitudeDegrees: 0.0); // returns 111319.9
Longitude::metersPerDegree(latitudeDegrees: -45.0); // returns 78715.056171
Longitude::metersPerDegree(latitudeDegrees: -45.0); // returns 78715.056171
Longitude::degreesFromMeters(Longitude::METERS_PER_DEGREE_AT_EQUATOR, latitudeDegrees: 0.0); // returns 1.0
Longitude::degreesFromMeters(Longitude::METERS_PER_DEGREE_AT_EQUATOR, latitudeDegrees: 90.0); // returns INF
Longitude::kilometersFromDegrees(1.0, latitudeDegrees: -45.0); // returns 78.715056
```

## FloatCompare

Testing floating point values for equality [is problematic](https://www.php.net/manual/en/language.types.float.php), due to the way that they are represented internally. To test floating point values for equality, an upper bound on the relative error due to rounding is used. This delta is the smallest acceptable difference in calculations.

The methods implemented into the **FloatCompare** class allow comparing float numbers due to an internal delta value.

```php
use Powlam\Coordinates\Utils\FloatCompare;

FloatCompare::equals(1.0, 1.000001); // returns true

FloatCompare::equalOrLessThan(1.0, 0.9999999) // returns true
FloatCompare::equalOrLessThan(1.0, 2.0) // returns true
```

**Coordinates for PHP** was created by **[Paul Albandoz](https://github.com/powlam)** under the **[MIT license](https://opensource.org/licenses/MIT)**.
