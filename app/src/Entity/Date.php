<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A date value in \[ISO 8601 date format\](http://en.wikipedia.org/wiki/ISO\_8601).
 *
 * @see https://schema.org/Date
 */
#[ORM\Entity]
#[ORM\Table(name: '`date`')]
#[ApiResource(types: ['https://schema.org/Date'])]
class Date
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
