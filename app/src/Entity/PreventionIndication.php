<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An indication for preventing an underlying condition, symptom, etc.
 *
 * @see https://schema.org/PreventionIndication
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PreventionIndication'])]
class PreventionIndication extends MedicalIndication
{
}
