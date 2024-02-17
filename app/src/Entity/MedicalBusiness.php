<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A particular physical or virtual business of an organization for medical purposes. Examples of MedicalBusiness include different businesses run by health professionals.
 *
 * @see https://schema.org/MedicalBusiness
 */
#[ORM\MappedSuperclass]
abstract class MedicalBusiness extends LocalBusiness
{
}
