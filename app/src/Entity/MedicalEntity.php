<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Enum\MedicalSpecialty;
use App\Enum\MedicineSystem;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The most generic type of entity related to health and the practice of medicine.
 *
 * @see https://schema.org/MedicalEntity
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
	'medicalEntity' => MedicalEntity::class,
	'medicalGuideline' => MedicalGuideline::class,
	'medicalRiskFactor' => MedicalRiskFactor::class,
	'substance' => Substance::class,
	'medicalContraindication' => MedicalContraindication::class,
	'superficialAnatomy' => SuperficialAnatomy::class,
	'anatomicalStructure' => AnatomicalStructure::class,
	'medicalDevice' => MedicalDevice::class,
	'anatomicalSystem' => AnatomicalSystem::class,
	'medicalTest' => MedicalTest::class,
	'drugCost' => DrugCost::class,
	'medicalStudy' => MedicalStudy::class,
	'drugClass' => DrugClass::class,
	'medicalCause' => MedicalCause::class,
	'medicalCondition' => MedicalCondition::class,
	'medicalGuidelineContraindication' => MedicalGuidelineContraindication::class,
	'medicalGuidelineRecommendation' => MedicalGuidelineRecommendation::class,
	'approvedIndication' => ApprovedIndication::class,
	'preventionIndication' => PreventionIndication::class,
	'treatmentIndication' => TreatmentIndication::class,
	'bone' => Bone::class,
	'ligament' => Ligament::class,
	'vessel' => Vessel::class,
	'brainStructure' => BrainStructure::class,
	'nerve' => Nerve::class,
	'joint' => Joint::class,
	'muscle' => Muscle::class,
	'surgicalProcedure' => SurgicalProcedure::class,
	'diagnosticProcedure' => DiagnosticProcedure::class,
	'physicalExam' => PhysicalExam::class,
	'bloodTest' => BloodTest::class,
	'pathologyTest' => PathologyTest::class,
	'imagingTest' => ImagingTest::class,
	'medicalTestPanel' => MedicalTestPanel::class,
	'medicalTrial' => MedicalTrial::class,
	'medicalObservationalStudy' => MedicalObservationalStudy::class,
	'medicalConditionStage' => MedicalConditionStage::class,
	'drugLegalStatus' => DrugLegalStatus::class,
	'medicalCode' => MedicalCode::class,
	'doseSchedule' => DoseSchedule::class,
	'dDxElement' => DDxElement::class,
	'drugStrength' => DrugStrength::class,
	'physicalActivity' => PhysicalActivity::class,
	'medicalRiskCalculator' => MedicalRiskCalculator::class,
	'medicalRiskScore' => MedicalRiskScore::class,
	'medicalSignOrSymptom' => MedicalSignOrSymptom::class,
	'infectiousDisease' => InfectiousDisease::class,
	'artery' => Artery::class,
	'vein' => Vein::class,
	'lymphaticVessel' => LymphaticVessel::class,
	'psychologicalTreatment' => PsychologicalTreatment::class,
	'medicalTherapy' => MedicalTherapy::class,
	'reportedDoseSchedule' => ReportedDoseSchedule::class,
	'maximumDoseSchedule' => MaximumDoseSchedule::class,
	'recommendedDoseSchedule' => RecommendedDoseSchedule::class,
	'medicalSymptom' => MedicalSymptom::class,
	'medicalSign' => MedicalSign::class,
	'radiationTherapy' => RadiationTherapy::class,
	'occupationalTherapy' => OccupationalTherapy::class,
	'physicalTherapy' => PhysicalTherapy::class,
	'palliativeProcedure' => PalliativeProcedure::class,
	'vitalSign' => VitalSign::class,
])]
class MedicalEntity extends Thing
{
	/**
	 * A medical guideline related to this entity.
	 *
	 * @see https://schema.org/guideline
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MedicalGuideline')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/guideline'])]
	#[Assert\NotNull]
	private MedicalGuideline $guideline;

	/**
	 * The drug or supplement's legal status, including any controlled substance schedules that apply.
	 *
	 * @see https://schema.org/legalStatus
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/legalStatus'])]
	private ?string $legalStatus = null;

	/**
	 * A medical study or trial related to this entity.
	 *
	 * @see https://schema.org/study
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MedicalStudy')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/study'])]
	#[Assert\NotNull]
	private MedicalStudy $study;

	/**
	 * The system of medicine that includes this MedicalEntity, for example 'evidence-based', 'homeopathic', 'chiropractic', etc.
	 *
	 * @see https://schema.org/medicineSystem
	 */
	#[ORM\Column(nullable: true)]
	#[ApiProperty(types: ['https://schema.org/medicineSystem'])]
	#[Assert\Choice(callback: [MedicineSystem::class, 'toArray'])]
	private ?string $medicineSystem = null;

	/**
	 * A medical code for the entity, taken from a controlled vocabulary or ontology such as ICD-9, DiseasesDB, MeSH, SNOMED-CT, RxNorm, etc.
	 *
	 * @see https://schema.org/code
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MedicalCode')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/code'])]
	#[Assert\NotNull]
	private MedicalCode $code;

	/**
	 * If applicable, a medical specialty in which this entity is relevant.
	 *
	 * @see https://schema.org/relevantSpecialty
	 */
	#[ORM\Column]
	#[ApiProperty(types: ['https://schema.org/relevantSpecialty'])]
	#[Assert\NotNull]
	#[Assert\Choice(callback: [MedicalSpecialty::class, 'toArray'])]
	private string $relevantSpecialty;

	/**
	 * If applicable, the organization that officially recognizes this entity as part of its endorsed system of medicine.
	 *
	 * @see https://schema.org/recognizingAuthority
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/recognizingAuthority'])]
	#[Assert\NotNull]
	private Organization $recognizingAuthority;

	/**
	 * A \[\[Grant\]\] that directly or indirectly provide funding or sponsorship for this item. See also \[\[ownershipFundingInfo\]\].
	 *
	 * @see https://schema.org/funding
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Grant')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/funding'])]
	#[Assert\NotNull]
	private Grant $funding;

	public function setGuideline(MedicalGuideline $guideline): void
	{
		$this->guideline = $guideline;
	}

	public function getGuideline(): MedicalGuideline
	{
		return $this->guideline;
	}

	public function setLegalStatus(?string $legalStatus): void
	{
		$this->legalStatus = $legalStatus;
	}

	public function getLegalStatus(): ?string
	{
		return $this->legalStatus;
	}

	public function setStudy(MedicalStudy $study): void
	{
		$this->study = $study;
	}

	public function getStudy(): MedicalStudy
	{
		return $this->study;
	}

	public function setMedicineSystem(?string $medicineSystem): void
	{
		$this->medicineSystem = $medicineSystem;
	}

	public function getMedicineSystem(): ?string
	{
		return $this->medicineSystem;
	}

	public function setCode(MedicalCode $code): void
	{
		$this->code = $code;
	}

	public function getCode(): MedicalCode
	{
		return $this->code;
	}

	public function setRelevantSpecialty(string $relevantSpecialty): void
	{
		$this->relevantSpecialty = $relevantSpecialty;
	}

	public function getRelevantSpecialty(): string
	{
		return $this->relevantSpecialty;
	}

	public function setRecognizingAuthority(Organization $recognizingAuthority): void
	{
		$this->recognizingAuthority = $recognizingAuthority;
	}

	public function getRecognizingAuthority(): Organization
	{
		return $this->recognizingAuthority;
	}

	public function setFunding(Grant $funding): void
	{
		$this->funding = $funding;
	}

	public function getFunding(): Grant
	{
		return $this->funding;
	}
}
