<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Any anatomical structure which pertains to the soft nervous tissue functioning as the coordinating center of sensation and intellectual and nervous activity.
 *
 * @see https://schema.org/BrainStructure
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/BrainStructure'])]
class BrainStructure extends AnatomicalStructure
{
}
