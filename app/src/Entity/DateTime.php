<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A combination of date and time of day in the form \[-\]CCYY-MM-DDThh:mm:ss\[Z|(+|-)hh:mm\] (see Chapter 5.4 of ISO 8601).
 *
 * @see https://schema.org/DateTime
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DateTime'])]
class DateTime
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
