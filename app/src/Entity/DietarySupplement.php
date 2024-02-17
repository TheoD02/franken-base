<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A product taken by mouth that contains a dietary ingredient intended to supplement the diet. Dietary ingredients may include vitamins, minerals, herbs or other botanicals, amino acids, and substances such as enzymes, organ tissues, glandulars and metabolites.
 *
 * @see https://schema.org/DietarySupplement
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DietarySupplement'])]
class DietarySupplement extends Product
{
    /**
     * Recommended intake of this supplement for a given population as defined by a specific recommending authority.
     *
     * @see https://schema.org/recommendedIntake
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\RecommendedDoseSchedule')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/recommendedIntake'])]
    #[Assert\NotNull]
    private RecommendedDoseSchedule $recommendedIntake;

    /**
     * The specific biochemical interaction through which this drug or supplement produces its pharmacological effect.
     *
     * @see https://schema.org/mechanismOfAction
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/mechanismOfAction'])]
    private ?string $mechanismOfAction = null;

    /**
     * Proprietary name given to the diet plan, typically by its originator or creator.
     *
     * @see https://schema.org/proprietaryName
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/proprietaryName'])]
    private ?string $proprietaryName = null;

    /**
     * The drug or supplement's legal status, including any controlled substance schedules that apply.
     *
     * @see https://schema.org/legalStatus
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/legalStatus'])]
    private ?string $legalStatus = null;

    /**
     * Any potential safety concern associated with the supplement. May include interactions with other drugs and foods, pregnancy, breastfeeding, known adverse reactions, and documented efficacy of the supplement.
     *
     * @see https://schema.org/safetyConsideration
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/safetyConsideration'])]
    private ?string $safetyConsideration = null;

    /**
     * Characteristics of the population for which this is intended, or which typically uses it, e.g. 'adults'.
     *
     * @see https://schema.org/targetPopulation
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/targetPopulation'])]
    private ?string $targetPopulation = null;

    /**
     * An active ingredient, typically chemical compounds and/or biologic substances.
     *
     * @see https://schema.org/activeIngredient
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/activeIngredient'])]
    private ?string $activeIngredient = null;

    /**
     * The generic name of this drug or supplement.
     *
     * @see https://schema.org/nonProprietaryName
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/nonProprietaryName'])]
    private ?string $nonProprietaryName = null;

    /**
     * True if this item's name is a proprietary/brand name (vs. generic name).
     *
     * @see https://schema.org/isProprietary
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Boolean')]
    #[ApiProperty(types: ['https://schema.org/isProprietary'])]
    private ?bool $isProprietary = null;

    /**
     * Recommended intake of this supplement for a given population as defined by a specific recommending authority.
     *
     * @see https://schema.org/maximumIntake
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MaximumDoseSchedule')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/maximumIntake'])]
    #[Assert\NotNull]
    private MaximumDoseSchedule $maximumIntake;

    public function setRecommendedIntake(RecommendedDoseSchedule $recommendedIntake): void
    {
        $this->recommendedIntake = $recommendedIntake;
    }

    public function getRecommendedIntake(): RecommendedDoseSchedule
    {
        return $this->recommendedIntake;
    }

    public function setMechanismOfAction(?string $mechanismOfAction): void
    {
        $this->mechanismOfAction = $mechanismOfAction;
    }

    public function getMechanismOfAction(): ?string
    {
        return $this->mechanismOfAction;
    }

    public function setProprietaryName(?string $proprietaryName): void
    {
        $this->proprietaryName = $proprietaryName;
    }

    public function getProprietaryName(): ?string
    {
        return $this->proprietaryName;
    }

    public function setLegalStatus(?string $legalStatus): void
    {
        $this->legalStatus = $legalStatus;
    }

    public function getLegalStatus(): ?string
    {
        return $this->legalStatus;
    }

    public function setSafetyConsideration(?string $safetyConsideration): void
    {
        $this->safetyConsideration = $safetyConsideration;
    }

    public function getSafetyConsideration(): ?string
    {
        return $this->safetyConsideration;
    }

    public function setTargetPopulation(?string $targetPopulation): void
    {
        $this->targetPopulation = $targetPopulation;
    }

    public function getTargetPopulation(): ?string
    {
        return $this->targetPopulation;
    }

    public function setActiveIngredient(?string $activeIngredient): void
    {
        $this->activeIngredient = $activeIngredient;
    }

    public function getActiveIngredient(): ?string
    {
        return $this->activeIngredient;
    }

    public function setNonProprietaryName(?string $nonProprietaryName): void
    {
        $this->nonProprietaryName = $nonProprietaryName;
    }

    public function getNonProprietaryName(): ?string
    {
        return $this->nonProprietaryName;
    }

    public function setIsProprietary(?bool $isProprietary): void
    {
        $this->isProprietary = $isProprietary;
    }

    public function getIsProprietary(): ?bool
    {
        return $this->isProprietary;
    }

    public function setMaximumIntake(MaximumDoseSchedule $maximumIntake): void
    {
        $this->maximumIntake = $maximumIntake;
    }

    public function getMaximumIntake(): MaximumDoseSchedule
    {
        return $this->maximumIntake;
    }
}
