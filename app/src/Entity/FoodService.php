<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A food service, like breakfast, lunch, or dinner.
 *
 * @see https://schema.org/FoodService
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/FoodService'])]
class FoodService extends Service
{
}
