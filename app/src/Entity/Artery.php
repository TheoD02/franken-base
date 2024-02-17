<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A type of blood vessel that specifically carries blood away from the heart.
 *
 * @see https://schema.org/Artery
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Artery'])]
class Artery extends Vessel
{
    /**
     * The branches that comprise the arterial structure.
     *
     * @see https://schema.org/arterialBranch
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\AnatomicalStructure')]
    #[ApiProperty(types: ['https://schema.org/arterialBranch'])]
    private ?AnatomicalStructure $arterialBranch = null;

    /**
     * The area to which the artery supplies blood.
     *
     * @see https://schema.org/supplyTo
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\AnatomicalStructure')]
    #[ApiProperty(types: ['https://schema.org/supplyTo'])]
    private ?AnatomicalStructure $supplyTo = null;

    public function setArterialBranch(?AnatomicalStructure $arterialBranch): void
    {
        $this->arterialBranch = $arterialBranch;
    }

    public function getArterialBranch(): ?AnatomicalStructure
    {
        return $this->arterialBranch;
    }

    public function setSupplyTo(?AnatomicalStructure $supplyTo): void
    {
        $this->supplyTo = $supplyTo;
    }

    public function getSupplyTo(): ?AnatomicalStructure
    {
        return $this->supplyTo;
    }
}
