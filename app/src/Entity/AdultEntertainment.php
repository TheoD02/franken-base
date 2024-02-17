<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An adult entertainment establishment.
 *
 * @see https://schema.org/AdultEntertainment
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/AdultEntertainment'])]
class AdultEntertainment extends EntertainmentBusiness
{
}
