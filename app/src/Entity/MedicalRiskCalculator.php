<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A complex mathematical calculation requiring an online calculator, used to assess prognosis. Note: use the url property of Thing to record any URLs for online calculators.
 *
 * @see https://schema.org/MedicalRiskCalculator
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MedicalRiskCalculator'])]
class MedicalRiskCalculator extends MedicalRiskEstimator
{
}
