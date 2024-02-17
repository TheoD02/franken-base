<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Lists or enumerations—for example, a list of cuisines or music genres, etc.
 *
 * @see https://schema.org/Enumeration
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Enumeration'])]
class Enumeration extends Intangible
{
    /**
     * Relates a term (i.e. a property, class or enumeration) to one that supersedes it.
     *
     * @see https://schema.org/supersededBy
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Class_')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/supersededBy'])]
    #[Assert\NotNull]
    private Class_ $supersededBy;

    public function setSupersededBy(Class_ $supersededBy): void
    {
        $this->supersededBy = $supersededBy;
    }

    public function getSupersededBy(): Class_
    {
        return $this->supersededBy;
    }
}
