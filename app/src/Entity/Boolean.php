<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Boolean: True or False.
 *
 * @see https://schema.org/Boolean
 */
#[ORM\Entity]
#[ORM\Table(name: '`boolean`')]
#[ApiResource(types: ['https://schema.org/Boolean'])]
class Boolean
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
