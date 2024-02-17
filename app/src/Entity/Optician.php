<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A store that sells reading glasses and similar devices for improving vision.
 *
 * @see https://schema.org/Optician
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Optician'])]
class Optician extends MedicalBusiness
{
}
