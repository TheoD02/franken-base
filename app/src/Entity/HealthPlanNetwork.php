<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * A US-style health insurance plan network.
 *
 * @see https://schema.org/HealthPlanNetwork
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/HealthPlanNetwork'])]
class HealthPlanNetwork extends Intangible
{
    /**
     * Name or unique ID of network. (Networks are often reused across different insurance plans.).
     *
     * @see https://schema.org/healthPlanNetworkId
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/healthPlanNetworkId'])]
    private ?string $healthPlanNetworkId = null;

    /**
     * The costs to the patient for services under this network or formulary.
     *
     * @see https://schema.org/healthPlanCostSharing
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Boolean')]
    #[ApiProperty(types: ['https://schema.org/healthPlanCostSharing'])]
    private ?bool $healthPlanCostSharing = null;

    /**
     * @var Collection<Text>|null the tier(s) for this network
     *
     * @see https://schema.org/healthPlanNetworkTier
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'health_plan_network_text_health_plan_network_tier')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/healthPlanNetworkTier'])]
    private ?Collection $healthPlanNetworkTier = null;

    public function __construct()
    {
        $this->healthPlanNetworkTier = new ArrayCollection();
    }

    public function setHealthPlanNetworkId(?string $healthPlanNetworkId): void
    {
        $this->healthPlanNetworkId = $healthPlanNetworkId;
    }

    public function getHealthPlanNetworkId(): ?string
    {
        return $this->healthPlanNetworkId;
    }

    public function setHealthPlanCostSharing(?bool $healthPlanCostSharing): void
    {
        $this->healthPlanCostSharing = $healthPlanCostSharing;
    }

    public function getHealthPlanCostSharing(): ?bool
    {
        return $this->healthPlanCostSharing;
    }

    public function addHealthPlanNetworkTier(string $healthPlanNetworkTier): void
    {
        $this->healthPlanNetworkTier[] = $healthPlanNetworkTier;
    }

    public function removeHealthPlanNetworkTier(string $healthPlanNetworkTier): void
    {
        $this->healthPlanNetworkTier->removeElement($healthPlanNetworkTier);
    }

    /**
     * @return Collection<Text>|null
     */
    public function getHealthPlanNetworkTier(): Collection
    {
        return $this->healthPlanNetworkTier;
    }
}
