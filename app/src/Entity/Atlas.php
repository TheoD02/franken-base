<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * A collection or bound volume of maps, charts, plates or tables, physical or in media form illustrating any subject.
 *
 * @see https://schema.org/Atlas
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Atlas'])]
class Atlas extends CreativeWork
{
}
