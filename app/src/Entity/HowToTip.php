<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An explanation in the instructions for how to achieve a result. It provides supplementary information about a technique, supply, author's preference, etc. It can explain what could be done, or what should not be done, but doesn't specify what should be done (see HowToDirection).
 *
 * @see https://schema.org/HowToTip
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/HowToTip'])]
class HowToTip extends CreativeWork
{
}
