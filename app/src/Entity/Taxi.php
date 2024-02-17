<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A taxi.
 *
 * @see https://schema.org/Taxi
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Taxi'])]
class Taxi extends Service
{
}
