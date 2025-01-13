<?php

namespace Powlam\Coordinates\Interfaces;

use Powlam\Coordinates\Enums\Heading;
use Powlam\Coordinates\Enums\Units;

interface Movable
{
    public function move(Heading $heading, float $distance, Units $units = Units::DEGREES): static;
}
