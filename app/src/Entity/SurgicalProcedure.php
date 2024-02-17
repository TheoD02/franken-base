<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A medical procedure involving an incision with instruments; performed for diagnose, or therapeutic purposes.
 *
 * @see https://schema.org/SurgicalProcedure
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SurgicalProcedure'])]
class SurgicalProcedure extends MedicalProcedure
{
}
