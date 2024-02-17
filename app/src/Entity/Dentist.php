<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A dentist.
 *
 * @see https://schema.org/Dentist
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Dentist'])]
class Dentist extends LocalBusiness
{
}
