<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A motorized bicycle is a bicycle with an attached motor used to power the vehicle, or to assist with pedaling.
 *
 * @see https://schema.org/MotorizedBicycle
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MotorizedBicycle'])]
class MotorizedBicycle extends Vehicle
{
}
