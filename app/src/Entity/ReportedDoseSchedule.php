<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A patient-reported or observed dosing schedule for a drug or supplement.
 *
 * @see https://schema.org/ReportedDoseSchedule
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ReportedDoseSchedule'])]
class ReportedDoseSchedule extends DoseSchedule
{
}
