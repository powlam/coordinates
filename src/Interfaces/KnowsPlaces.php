<?php

namespace Powlam\Coordinates\Interfaces;

use Powlam\Coordinates\Enums\Place;

interface KnowsPlaces
{
    public function isPlace(Place $place): bool;
}
