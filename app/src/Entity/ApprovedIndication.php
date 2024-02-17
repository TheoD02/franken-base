<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An indication for a medical therapy that has been formally specified or approved by a regulatory body that regulates use of the therapy; for example, the US FDA approves indications for most drugs in the US.
 *
 * @see https://schema.org/ApprovedIndication
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ApprovedIndication'])]
class ApprovedIndication extends MedicalIndication
{
}
