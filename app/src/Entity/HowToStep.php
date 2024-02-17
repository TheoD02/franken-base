<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A step in the instructions for how to achieve a result. It is an ordered list with HowToDirection and/or HowToTip items.
 *
 * @see https://schema.org/HowToStep
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/HowToStep'])]
class HowToStep extends CreativeWork
{
}
