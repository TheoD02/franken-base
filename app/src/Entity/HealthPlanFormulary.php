<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * For a given health insurance plan, the specification for costs and coverage of prescription drugs.
 *
 * @see https://schema.org/HealthPlanFormulary
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/HealthPlanFormulary'])]
class HealthPlanFormulary extends Intangible
{
    /**
     * Whether prescriptions can be delivered by mail.
     *
     * @see https://schema.org/offersPrescriptionByMail
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Boolean')]
    #[ApiProperty(types: ['https://schema.org/offersPrescriptionByMail'])]
    private ?bool $offersPrescriptionByMail = null;

    /**
     * @var Collection<Text>|null the tier(s) of drugs offered by this formulary or insurance plan
     *
     * @see https://schema.org/healthPlanDrugTier
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'health_plan_formulary_text_health_plan_drug_tier')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/healthPlanDrugTier'])]
    private ?Collection $healthPlanDrugTier = null;

    /**
     * The costs to the patient for services under this network or formulary.
     *
     * @see https://schema.org/healthPlanCostSharing
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Boolean')]
    #[ApiProperty(types: ['https://schema.org/healthPlanCostSharing'])]
    private ?bool $healthPlanCostSharing = null;

    public function __construct()
    {
        $this->healthPlanDrugTier = new ArrayCollection();
    }

    public function setOffersPrescriptionByMail(?bool $offersPrescriptionByMail): void
    {
        $this->offersPrescriptionByMail = $offersPrescriptionByMail;
    }

    public function getOffersPrescriptionByMail(): ?bool
    {
        return $this->offersPrescriptionByMail;
    }

    public function addHealthPlanDrugTier(string $healthPlanDrugTier): void
    {
        $this->healthPlanDrugTier[] = $healthPlanDrugTier;
    }

    public function removeHealthPlanDrugTier(string $healthPlanDrugTier): void
    {
        $this->healthPlanDrugTier->removeElement($healthPlanDrugTier);
    }

    /**
     * @return Collection<Text>|null
     */
    public function getHealthPlanDrugTier(): Collection
    {
        return $this->healthPlanDrugTier;
    }

    public function setHealthPlanCostSharing(?bool $healthPlanCostSharing): void
    {
        $this->healthPlanCostSharing = $healthPlanCostSharing;
    }

    public function getHealthPlanCostSharing(): ?bool
    {
        return $this->healthPlanCostSharing;
    }
}
