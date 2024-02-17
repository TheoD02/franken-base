<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A medical test performed on a sample of a patient's blood.
 *
 * @see https://schema.org/BloodTest
 *
 * @internal
 *
 * @coversNothing
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/BloodTest'])]
class BloodTest extends MedicalTest
{
}
