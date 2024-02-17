<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A condition or factor that indicates use of a medical therapy, including signs, symptoms, risk factors, anatomical states, etc.
 *
 * @see https://schema.org/MedicalIndication
 */
#[ORM\MappedSuperclass]
abstract class MedicalIndication extends MedicalEntity
{
}
