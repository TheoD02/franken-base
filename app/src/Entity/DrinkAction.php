<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of swallowing liquids.
 *
 * @see https://schema.org/DrinkAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DrinkAction'])]
class DrinkAction extends ConsumeAction
{
}
