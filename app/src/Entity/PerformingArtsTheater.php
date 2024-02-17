<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A theater or other performing art center.
 *
 * @see https://schema.org/PerformingArtsTheater
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PerformingArtsTheater'])]
class PerformingArtsTheater extends CivicStructure
{
}
