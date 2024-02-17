<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Event type: Food event.
 *
 * @see https://schema.org/FoodEvent
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/FoodEvent'])]
class FoodEvent extends Event
{
}
