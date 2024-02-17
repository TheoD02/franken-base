<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A guideline contraindication that designates a process as harmful and where quality of the data supporting the contraindication is sound.
 *
 * @see https://schema.org/MedicalGuidelineContraindication
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MedicalGuidelineContraindication'])]
class MedicalGuidelineContraindication extends MedicalGuideline
{
}
