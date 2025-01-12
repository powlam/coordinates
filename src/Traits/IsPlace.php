<?php

namespace Powlam\Coordinates\Traits;

use Powlam\Coordinates\Enums\Place;

trait IsPlace
{
    public function isPlace(Place $place): bool
    {
        $placeObject = $place->get();

        return is_a($placeObject, static::class) && $this->equals($placeObject);
    }
}
