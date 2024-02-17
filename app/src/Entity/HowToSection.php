<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A sub-grouping of steps in the instructions for how to achieve a result (e.g. steps for making a pie crust within a pie recipe).
 *
 * @see https://schema.org/HowToSection
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/HowToSection'])]
class HowToSection extends CreativeWork
{
}
