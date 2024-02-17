<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Enum\DrugPregnancyCategory;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A chemical or biologic substance, used as a medical therapy, that has a physiological effect on an organism. Here the term drug is used interchangeably with the term medicine although clinical knowledge makes a clear difference between them.
 *
 * @see https://schema.org/Drug
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Drug'])]
class Drug extends Product
{
    /**
     * Any other drug related to this one, for example commonly-prescribed alternatives.
     *
     * @see https://schema.org/relatedDrug
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Drug')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/relatedDrug'])]
    #[Assert\NotNull]
    private Drug $relatedDrug;

    /**
     * Pregnancy category of this drug.
     *
     * @see https://schema.org/pregnancyCategory
     */
    #[ORM\Column]
    #[ApiProperty(types: ['https://schema.org/pregnancyCategory'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [DrugPregnancyCategory::class, 'toArray'])]
    private string $pregnancyCategory;

    /**
     * Any precaution, guidance, contraindication, etc. related to this drug's use by breastfeeding mothers.
     *
     * @see https://schema.org/breastfeedingWarning
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/breastfeedingWarning'])]
    private ?string $breastfeedingWarning = null;

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
     * A dosing schedule for the drug for a given population, either observed, recommended, or maximum dose based on the type used.
     *
     * @see https://schema.org/doseSchedule
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\DoseSchedule')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/doseSchedule'])]
    #[Assert\NotNull]
    private DoseSchedule $doseSchedule;

    /**
     * Any information related to overdose on a drug, including signs or symptoms, treatments, contact information for emergency response.
     *
     * @see https://schema.org/overdosage
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/overdosage'])]
    private ?string $overdosage = null;

    /**
     * Link to prescribing information for the drug.
     *
     * @see https://schema.org/prescribingInfo
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
    #[ApiProperty(types: ['https://schema.org/prescribingInfo'])]
    #[Assert\Url]
    private ?string $prescribingInfo = null;

    /**
     * An available dosage strength for the drug.
     *
     * @see https://schema.org/availableStrength
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\DrugStrength')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/availableStrength'])]
    #[Assert\NotNull]
    private DrugStrength $availableStrength;

    /**
     * A route by which this drug may be administered, e.g. 'oral'.
     *
     * @see https://schema.org/administrationRoute
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/administrationRoute'])]
    private ?string $administrationRoute = null;

    /**
     * The insurance plans that cover this drug.
     *
     * @see https://schema.org/includedInHealthInsurancePlan
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\HealthInsurancePlan')]
    #[ApiProperty(types: ['https://schema.org/includedInHealthInsurancePlan'])]
    private ?HealthInsurancePlan $includedInHealthInsurancePlan = null;

    /**
     * Link to the drug's label details.
     *
     * @see https://schema.org/labelDetails
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
    #[ApiProperty(types: ['https://schema.org/labelDetails'])]
    #[Assert\Url]
    private ?string $labelDetails = null;

    /**
     * Another drug that is known to interact with this drug in a way that impacts the effect of this drug or causes a risk to the patient. Note: disease interactions are typically captured as contraindications.
     *
     * @see https://schema.org/interactingDrug
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Drug')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/interactingDrug'])]
    #[Assert\NotNull]
    private Drug $interactingDrug;

    /**
     * True if the drug is available in a generic form (regardless of name).
     *
     * @see https://schema.org/isAvailableGenerically
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Boolean')]
    #[ApiProperty(types: ['https://schema.org/isAvailableGenerically'])]
    private ?bool $isAvailableGenerically = null;

    /**
     * An active ingredient, typically chemical compounds and/or biologic substances.
     *
     * @see https://schema.org/activeIngredient
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/activeIngredient'])]
    private ?string $activeIngredient = null;

    /**
     * Any FDA or other warnings about the drug (text or URL).
     *
     * @see https://schema.org/warning
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/warning'])]
    private ?string $warning = null;

    /**
     * The generic name of this drug or supplement.
     *
     * @see https://schema.org/nonProprietaryName
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/nonProprietaryName'])]
    private ?string $nonProprietaryName = null;

    /**
     * A dosage form in which this drug/supplement is available, e.g. 'tablet', 'suspension', 'injection'.
     *
     * @see https://schema.org/dosageForm
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/dosageForm'])]
    private ?string $dosageForm = null;

    /**
     * True if this item's name is a proprietary/brand name (vs. generic name).
     *
     * @see https://schema.org/isProprietary
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Boolean')]
    #[ApiProperty(types: ['https://schema.org/isProprietary'])]
    private ?bool $isProprietary = null;

    /**
     * The unit in which the drug is measured, e.g. '5 mg tablet'.
     *
     * @see https://schema.org/drugUnit
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/drugUnit'])]
    private ?string $drugUnit = null;

    /**
     * The RxCUI drug identifier from RXNORM.
     *
     * @see https://schema.org/rxcui
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/rxcui'])]
    private ?string $rxcui = null;

    /**
     * Any precaution, guidance, contraindication, etc. related to this drug's use during pregnancy.
     *
     * @see https://schema.org/pregnancyWarning
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/pregnancyWarning'])]
    private ?string $pregnancyWarning = null;

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

    /**
     * Indicates the status of drug prescription, e.g. local catalogs classifications or whether the drug is available by prescription or over-the-counter, etc.
     *
     * @see https://schema.org/prescriptionStatus
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/prescriptionStatus'])]
    private ?string $prescriptionStatus = null;

    /**
     * Description of the absorption and elimination of drugs, including their concentration (pharmacokinetics, pK) and biological effects (pharmacodynamics, pD).
     *
     * @see https://schema.org/clinicalPharmacology
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/clinicalPharmacology'])]
    private ?string $clinicalPharmacology = null;

    /**
     * The class of drug this belongs to (e.g., statins).
     *
     * @see https://schema.org/drugClass
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\DrugClass')]
    #[ApiProperty(types: ['https://schema.org/drugClass'])]
    private ?DrugClass $drugClass = null;

    /**
     * Any precaution, guidance, contraindication, etc. related to consumption of alcohol while taking this drug.
     *
     * @see https://schema.org/alcoholWarning
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/alcoholWarning'])]
    private ?string $alcoholWarning = null;

    /**
     * Any precaution, guidance, contraindication, etc. related to consumption of specific foods while taking this drug.
     *
     * @see https://schema.org/foodWarning
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/foodWarning'])]
    private ?string $foodWarning = null;

    public function setRelatedDrug(Drug $relatedDrug): void
    {
        $this->relatedDrug = $relatedDrug;
    }

    public function getRelatedDrug(): Drug
    {
        return $this->relatedDrug;
    }

    public function setPregnancyCategory(string $pregnancyCategory): void
    {
        $this->pregnancyCategory = $pregnancyCategory;
    }

    public function getPregnancyCategory(): string
    {
        return $this->pregnancyCategory;
    }

    public function setBreastfeedingWarning(?string $breastfeedingWarning): void
    {
        $this->breastfeedingWarning = $breastfeedingWarning;
    }

    public function getBreastfeedingWarning(): ?string
    {
        return $this->breastfeedingWarning;
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

    public function setDoseSchedule(DoseSchedule $doseSchedule): void
    {
        $this->doseSchedule = $doseSchedule;
    }

    public function getDoseSchedule(): DoseSchedule
    {
        return $this->doseSchedule;
    }

    public function setOverdosage(?string $overdosage): void
    {
        $this->overdosage = $overdosage;
    }

    public function getOverdosage(): ?string
    {
        return $this->overdosage;
    }

    public function setPrescribingInfo(?string $prescribingInfo): void
    {
        $this->prescribingInfo = $prescribingInfo;
    }

    public function getPrescribingInfo(): ?string
    {
        return $this->prescribingInfo;
    }

    public function setAvailableStrength(DrugStrength $availableStrength): void
    {
        $this->availableStrength = $availableStrength;
    }

    public function getAvailableStrength(): DrugStrength
    {
        return $this->availableStrength;
    }

    public function setAdministrationRoute(?string $administrationRoute): void
    {
        $this->administrationRoute = $administrationRoute;
    }

    public function getAdministrationRoute(): ?string
    {
        return $this->administrationRoute;
    }

    public function setIncludedInHealthInsurancePlan(?HealthInsurancePlan $includedInHealthInsurancePlan): void
    {
        $this->includedInHealthInsurancePlan = $includedInHealthInsurancePlan;
    }

    public function getIncludedInHealthInsurancePlan(): ?HealthInsurancePlan
    {
        return $this->includedInHealthInsurancePlan;
    }

    public function setLabelDetails(?string $labelDetails): void
    {
        $this->labelDetails = $labelDetails;
    }

    public function getLabelDetails(): ?string
    {
        return $this->labelDetails;
    }

    public function setInteractingDrug(Drug $interactingDrug): void
    {
        $this->interactingDrug = $interactingDrug;
    }

    public function getInteractingDrug(): Drug
    {
        return $this->interactingDrug;
    }

    public function setIsAvailableGenerically(?bool $isAvailableGenerically): void
    {
        $this->isAvailableGenerically = $isAvailableGenerically;
    }

    public function getIsAvailableGenerically(): ?bool
    {
        return $this->isAvailableGenerically;
    }

    public function setActiveIngredient(?string $activeIngredient): void
    {
        $this->activeIngredient = $activeIngredient;
    }

    public function getActiveIngredient(): ?string
    {
        return $this->activeIngredient;
    }

    public function setWarning(?string $warning): void
    {
        $this->warning = $warning;
    }

    public function getWarning(): ?string
    {
        return $this->warning;
    }

    public function setNonProprietaryName(?string $nonProprietaryName): void
    {
        $this->nonProprietaryName = $nonProprietaryName;
    }

    public function getNonProprietaryName(): ?string
    {
        return $this->nonProprietaryName;
    }

    public function setDosageForm(?string $dosageForm): void
    {
        $this->dosageForm = $dosageForm;
    }

    public function getDosageForm(): ?string
    {
        return $this->dosageForm;
    }

    public function setIsProprietary(?bool $isProprietary): void
    {
        $this->isProprietary = $isProprietary;
    }

    public function getIsProprietary(): ?bool
    {
        return $this->isProprietary;
    }

    public function setDrugUnit(?string $drugUnit): void
    {
        $this->drugUnit = $drugUnit;
    }

    public function getDrugUnit(): ?string
    {
        return $this->drugUnit;
    }

    public function setRxcui(?string $rxcui): void
    {
        $this->rxcui = $rxcui;
    }

    public function getRxcui(): ?string
    {
        return $this->rxcui;
    }

    public function setPregnancyWarning(?string $pregnancyWarning): void
    {
        $this->pregnancyWarning = $pregnancyWarning;
    }

    public function getPregnancyWarning(): ?string
    {
        return $this->pregnancyWarning;
    }

    public function setMaximumIntake(MaximumDoseSchedule $maximumIntake): void
    {
        $this->maximumIntake = $maximumIntake;
    }

    public function getMaximumIntake(): MaximumDoseSchedule
    {
        return $this->maximumIntake;
    }

    public function setPrescriptionStatus(?string $prescriptionStatus): void
    {
        $this->prescriptionStatus = $prescriptionStatus;
    }

    public function getPrescriptionStatus(): ?string
    {
        return $this->prescriptionStatus;
    }

    public function setClinicalPharmacology(?string $clinicalPharmacology): void
    {
        $this->clinicalPharmacology = $clinicalPharmacology;
    }

    public function getClinicalPharmacology(): ?string
    {
        return $this->clinicalPharmacology;
    }

    public function setDrugClass(?DrugClass $drugClass): void
    {
        $this->drugClass = $drugClass;
    }

    public function getDrugClass(): ?DrugClass
    {
        return $this->drugClass;
    }

    public function setAlcoholWarning(?string $alcoholWarning): void
    {
        $this->alcoholWarning = $alcoholWarning;
    }

    public function getAlcoholWarning(): ?string
    {
        return $this->alcoholWarning;
    }

    public function setFoodWarning(?string $foodWarning): void
    {
        $this->foodWarning = $foodWarning;
    }

    public function getFoodWarning(): ?string
    {
        return $this->foodWarning;
    }
}
