<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The maximum dosing schedule considered safe for a drug or supplement as recommended by an authority or by the drug/supplement's manufacturer. Capture the recommending authority in the recognizingAuthority property of MedicalEntity.
 *
 * @see https://schema.org/MaximumDoseSchedule
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MaximumDoseSchedule'])]
class MaximumDoseSchedule extends DoseSchedule
{
}
