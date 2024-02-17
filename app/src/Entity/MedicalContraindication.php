<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A condition or factor that serves as a reason to withhold a certain medical therapy. Contraindications can be absolute (there are no reasonable circumstances for undertaking a course of action) or relative (the patient is at higher risk of complications, but these risks may be outweighed by other considerations or mitigated by other measures).
 *
 * @see https://schema.org/MedicalContraindication
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MedicalContraindication'])]
class MedicalContraindication extends MedicalEntity
{
}
