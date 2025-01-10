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

# Classes

## LatLng class

A LatLng is a point in geographic coordinates: latitude and longitude. Both parameters are of float type.

* **Latitude** ranges between -90 and 90 degrees inclusive. Values above or below this range will be clamped to the range [-90, 90]. This means that if the specified value is less than -90, it will be set to -90. And if the value is greater than 90, it will be set to 90.
* **Longitude** ranges between -180 and 180 degrees inclusive. Values above or below this range will be adjusted to fit within the range. For example, a value of -190 will become 170. A value of 190 will become -170. This reflects the fact that longitudes wrap around the globe.

## LatLngAltitude class

A LatLngAltitude is a 3D point in geographic coordinates: latitude, longitude, and altitude.

* **Altitude** is measured in meters. Positive values indicate heights above ground level, and negative values indicate depths below the ground surface.

# Features

## Movement

Both **LatLng** and **LatLngAltitude** points are moveable, so they can be moved in any direction using the **move** method.

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

⚡️ This is still a work in progress...

**Coordinates for PHP** was created by **[Paul Albandoz](https://github.com/powlam)** under the **[MIT license](https://opensource.org/licenses/MIT)**.
