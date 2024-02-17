<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A US-style health insurance plan, including PPOs, EPOs, and HMOs.
 *
 * @see https://schema.org/HealthInsurancePlan
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/HealthInsurancePlan'])]
class HealthInsurancePlan extends Intangible
{
    /**
     * Formularies covered by this plan.
     *
     * @see https://schema.org/includesHealthPlanFormulary
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\HealthPlanFormulary')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/includesHealthPlanFormulary'])]
    #[Assert\NotNull]
    private HealthPlanFormulary $includesHealthPlanFormulary;

    /**
     * A contact point for a person or organization.
     *
     * @see https://schema.org/contactPoint
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\ContactPoint')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/contactPoint'])]
    #[Assert\NotNull]
    private ContactPoint $contactPoint;

    /**
     * TODO.
     *
     * @see https://schema.org/healthPlanDrugOption
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/healthPlanDrugOption'])]
    private ?string $healthPlanDrugOption = null;

    /**
     * @var Collection<Text>|null the tier(s) of drugs offered by this formulary or insurance plan
     *
     * @see https://schema.org/healthPlanDrugTier
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'health_insurance_plan_text_health_plan_drug_tier')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/healthPlanDrugTier'])]
    private ?Collection $healthPlanDrugTier = null;

    /**
     * Networks covered by this plan.
     *
     * @see https://schema.org/includesHealthPlanNetwork
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\HealthPlanNetwork')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/includesHealthPlanNetwork'])]
    #[Assert\NotNull]
    private HealthPlanNetwork $includesHealthPlanNetwork;

    /**
     * The standard for interpreting the Plan ID. The preferred is "HIOS". See the Centers for Medicare &amp; Medicaid Services for more details.
     *
     * @see https://schema.org/usesHealthPlanIdStandard
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/usesHealthPlanIdStandard'])]
    private ?string $usesHealthPlanIdStandard = null;

    /**
     * The URL that goes directly to the plan brochure for the specific standard plan or plan variation.
     *
     * @see https://schema.org/healthPlanMarketingUrl
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\URL')]
    #[ApiProperty(types: ['https://schema.org/healthPlanMarketingUrl'])]
    #[Assert\Url]
    private ?string $healthPlanMarketingUrl = null;

    /**
     * The 14-character, HIOS-generated Plan ID number. (Plan IDs must be unique, even across different markets.).
     *
     * @see https://schema.org/healthPlanId
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/healthPlanId'])]
    private ?string $healthPlanId = null;

    /**
     * The URL that goes directly to the summary of benefits and coverage for the specific standard plan or plan variation.
     *
     * @see https://schema.org/benefitsSummaryUrl
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\URL')]
    #[ApiProperty(types: ['https://schema.org/benefitsSummaryUrl'])]
    #[Assert\Url]
    private ?string $benefitsSummaryUrl = null;

    public function __construct()
    {
        $this->healthPlanDrugTier = new ArrayCollection();
    }

    public function setIncludesHealthPlanFormulary(HealthPlanFormulary $includesHealthPlanFormulary): void
    {
        $this->includesHealthPlanFormulary = $includesHealthPlanFormulary;
    }

    public function getIncludesHealthPlanFormulary(): HealthPlanFormulary
    {
        return $this->includesHealthPlanFormulary;
    }

    public function setContactPoint(ContactPoint $contactPoint): void
    {
        $this->contactPoint = $contactPoint;
    }

    public function getContactPoint(): ContactPoint
    {
        return $this->contactPoint;
    }

    public function setHealthPlanDrugOption(?string $healthPlanDrugOption): void
    {
        $this->healthPlanDrugOption = $healthPlanDrugOption;
    }

    public function getHealthPlanDrugOption(): ?string
    {
        return $this->healthPlanDrugOption;
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

    public function setIncludesHealthPlanNetwork(HealthPlanNetwork $includesHealthPlanNetwork): void
    {
        $this->includesHealthPlanNetwork = $includesHealthPlanNetwork;
    }

    public function getIncludesHealthPlanNetwork(): HealthPlanNetwork
    {
        return $this->includesHealthPlanNetwork;
    }

    public function setUsesHealthPlanIdStandard(?string $usesHealthPlanIdStandard): void
    {
        $this->usesHealthPlanIdStandard = $usesHealthPlanIdStandard;
    }

    public function getUsesHealthPlanIdStandard(): ?string
    {
        return $this->usesHealthPlanIdStandard;
    }

    public function setHealthPlanMarketingUrl(?string $healthPlanMarketingUrl): void
    {
        $this->healthPlanMarketingUrl = $healthPlanMarketingUrl;
    }

    public function getHealthPlanMarketingUrl(): ?string
    {
        return $this->healthPlanMarketingUrl;
    }

    public function setHealthPlanId(?string $healthPlanId): void
    {
        $this->healthPlanId = $healthPlanId;
    }

    public function getHealthPlanId(): ?string
    {
        return $this->healthPlanId;
    }

    public function setBenefitsSummaryUrl(?string $benefitsSummaryUrl): void
    {
        $this->benefitsSummaryUrl = $benefitsSummaryUrl;
    }

    public function getBenefitsSummaryUrl(): ?string
    {
        return $this->benefitsSummaryUrl;
    }
}
