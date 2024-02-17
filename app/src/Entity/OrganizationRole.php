<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;

/**
 * A subclass of Role used to describe roles within organizations.
 *
 * @see https://schema.org/OrganizationRole
 */
#[ORM\MappedSuperclass]
abstract class OrganizationRole extends Role
{
    /**
     * A number associated with a role in an organization, for example, the number on an athlete's jersey.
     *
     * @see https://schema.org/numberedPosition
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/numberedPosition'])]
    private ?string $numberedPosition = null;

    public function setNumberedPosition(?string $numberedPosition): void
    {
        $this->numberedPosition = $numberedPosition;
    }

    public function getNumberedPosition(): ?string
    {
        return $this->numberedPosition;
    }
}
