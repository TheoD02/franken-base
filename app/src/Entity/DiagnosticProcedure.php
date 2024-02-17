<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A medical procedure intended primarily for diagnostic, as opposed to therapeutic, purposes.
 *
 * @see https://schema.org/DiagnosticProcedure
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DiagnosticProcedure'])]
class DiagnosticProcedure extends MedicalProcedure
{
}
