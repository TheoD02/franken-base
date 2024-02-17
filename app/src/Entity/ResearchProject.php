<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Research project.
 *
 * @see https://schema.org/ResearchProject
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ResearchProject'])]
class ResearchProject extends Project
{
}
