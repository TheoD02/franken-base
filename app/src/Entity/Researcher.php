<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Researchers.
 *
 * @see https://schema.org/Researcher
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Researcher'])]
class Researcher extends Audience
{
}
