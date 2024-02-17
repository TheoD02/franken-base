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
use App\Enum\MedicalStudyStatus;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Any condition of the human body that affects the normal functioning of a person, whether physically or mentally. Includes diseases, injuries, disabilities, disorders, syndromes, etc.
 *
 * @see https://schema.org/MedicalCondition
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
	'medicalCondition' => MedicalCondition::class,
	'medicalSignOrSymptom' => MedicalSignOrSymptom::class,
	'infectiousDisease' => InfectiousDisease::class,
	'medicalSymptom' => MedicalSymptom::class,
	'medicalSign' => MedicalSign::class,
	'vitalSign' => VitalSign::class,
])]
class MedicalCondition extends MedicalEntity
{
	/**
	 * The likely outcome in either the short term or long term of the medical condition.
	 *
	 * @see https://schema.org/expectedPrognosis
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/expectedPrognosis'])]
	private ?string $expectedPrognosis = null;

	/**
	 * The characteristics of associated patients, such as age, gender, race etc.
	 *
	 * @see https://schema.org/epidemiology
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/epidemiology'])]
	private ?string $epidemiology = null;

	/**
	 * A sign or symptom of this condition. Signs are objective or physically observable manifestations of the medical condition while symptoms are the subjective experience of the medical condition.
	 *
	 * @see https://schema.org/signOrSymptom
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MedicalSignOrSymptom')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/signOrSymptom'])]
	#[Assert\NotNull]
	private MedicalSignOrSymptom $signOrSymptom;

	/**
	 * Changes in the normal mechanical, physical, and biochemical functions that are associated with this activity or condition.
	 *
	 * @see https://schema.org/pathophysiology
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/pathophysiology'])]
	private ?string $pathophysiology = null;

	/**
	 * The status of the study (enumerated).
	 *
	 * @see https://schema.org/status
	 */
	#[ORM\Column(nullable: true)]
	#[ApiProperty(types: ['https://schema.org/status'])]
	#[Assert\Choice(callback: [MedicalStudyStatus::class, 'toArray'])]
	private ?string $status = null;

	/**
	 * A modifiable or non-modifiable factor that increases the risk of a patient contracting this condition, e.g. age, coexisting condition.
	 *
	 * @see https://schema.org/riskFactor
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MedicalRiskFactor')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/riskFactor'])]
	#[Assert\NotNull]
	private MedicalRiskFactor $riskFactor;

	/**
	 * A possible unexpected and unfavorable evolution of a medical condition. Complications may include worsening of the signs or symptoms of the disease, extension of the condition to other organ systems, etc.
	 *
	 * @see https://schema.org/possibleComplication
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/possibleComplication'])]
	private ?string $possibleComplication = null;

	/**
	 * The stage of the condition, if applicable.
	 *
	 * @see https://schema.org/stage
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MedicalConditionStage')]
	#[ApiProperty(types: ['https://schema.org/stage'])]
	private ?MedicalConditionStage $stage = null;

	/**
	 * A possible treatment to address this condition, sign or symptom.
	 *
	 * @see https://schema.org/possibleTreatment
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MedicalTherapy')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/possibleTreatment'])]
	#[Assert\NotNull]
	private MedicalTherapy $possibleTreatment;

	/**
	 * The expected progression of the condition if it is not treated and allowed to progress naturally.
	 *
	 * @see https://schema.org/naturalProgression
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/naturalProgression'])]
	private ?string $naturalProgression = null;

	/**
	 * Specifying a drug or medicine used in a medication procedure.
	 *
	 * @see https://schema.org/drug
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Drug')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/drug'])]
	#[Assert\NotNull]
	private Drug $drug;

	/**
	 * A preventative therapy used to prevent an initial occurrence of the medical condition, such as vaccination.
	 *
	 * @see https://schema.org/primaryPrevention
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MedicalTherapy')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/primaryPrevention'])]
	#[Assert\NotNull]
	private MedicalTherapy $primaryPrevention;

	/**
	 * A preventative therapy used to prevent reoccurrence of the medical condition after an initial episode of the condition.
	 *
	 * @see https://schema.org/secondaryPrevention
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MedicalTherapy')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/secondaryPrevention'])]
	#[Assert\NotNull]
	private MedicalTherapy $secondaryPrevention;

	/**
	 * One of a set of differential diagnoses for the condition. Specifically, a closely-related or competing diagnosis typically considered later in the cognitive process whereby this medical condition is distinguished from others most likely responsible for a similar collection of signs and symptoms to reach the most parsimonious diagnosis or diagnoses in a patient.
	 *
	 * @see https://schema.org/differentialDiagnosis
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\DDxElement')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/differentialDiagnosis'])]
	#[Assert\NotNull]
	private DDxElement $differentialDiagnosis;

	/**
	 * The anatomy of the underlying organ system or structures associated with this entity.
	 *
	 * @see https://schema.org/associatedAnatomy
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\AnatomicalSystem')]
	#[ApiProperty(types: ['https://schema.org/associatedAnatomy'])]
	private ?AnatomicalSystem $associatedAnatomy = null;

	/**
	 * A medical test typically performed given this condition.
	 *
	 * @see https://schema.org/typicalTest
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MedicalTest')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/typicalTest'])]
	#[Assert\NotNull]
	private MedicalTest $typicalTest;

	public function setExpectedPrognosis(?string $expectedPrognosis): void
	{
		$this->expectedPrognosis = $expectedPrognosis;
	}

	public function getExpectedPrognosis(): ?string
	{
		return $this->expectedPrognosis;
	}

	public function setEpidemiology(?string $epidemiology): void
	{
		$this->epidemiology = $epidemiology;
	}

	public function getEpidemiology(): ?string
	{
		return $this->epidemiology;
	}

	public function setSignOrSymptom(MedicalSignOrSymptom $signOrSymptom): void
	{
		$this->signOrSymptom = $signOrSymptom;
	}

	public function getSignOrSymptom(): MedicalSignOrSymptom
	{
		return $this->signOrSymptom;
	}

	public function setPathophysiology(?string $pathophysiology): void
	{
		$this->pathophysiology = $pathophysiology;
	}

	public function getPathophysiology(): ?string
	{
		return $this->pathophysiology;
	}

	public function setStatus(?string $status): void
	{
		$this->status = $status;
	}

	public function getStatus(): ?string
	{
		return $this->status;
	}

	public function setRiskFactor(MedicalRiskFactor $riskFactor): void
	{
		$this->riskFactor = $riskFactor;
	}

	public function getRiskFactor(): MedicalRiskFactor
	{
		return $this->riskFactor;
	}

	public function setPossibleComplication(?string $possibleComplication): void
	{
		$this->possibleComplication = $possibleComplication;
	}

	public function getPossibleComplication(): ?string
	{
		return $this->possibleComplication;
	}

	public function setStage(?MedicalConditionStage $stage): void
	{
		$this->stage = $stage;
	}

	public function getStage(): ?MedicalConditionStage
	{
		return $this->stage;
	}

	public function setPossibleTreatment(MedicalTherapy $possibleTreatment): void
	{
		$this->possibleTreatment = $possibleTreatment;
	}

	public function getPossibleTreatment(): MedicalTherapy
	{
		return $this->possibleTreatment;
	}

	public function setNaturalProgression(?string $naturalProgression): void
	{
		$this->naturalProgression = $naturalProgression;
	}

	public function getNaturalProgression(): ?string
	{
		return $this->naturalProgression;
	}

	public function setDrug(Drug $drug): void
	{
		$this->drug = $drug;
	}

	public function getDrug(): Drug
	{
		return $this->drug;
	}

	public function setPrimaryPrevention(MedicalTherapy $primaryPrevention): void
	{
		$this->primaryPrevention = $primaryPrevention;
	}

	public function getPrimaryPrevention(): MedicalTherapy
	{
		return $this->primaryPrevention;
	}

	public function setSecondaryPrevention(MedicalTherapy $secondaryPrevention): void
	{
		$this->secondaryPrevention = $secondaryPrevention;
	}

	public function getSecondaryPrevention(): MedicalTherapy
	{
		return $this->secondaryPrevention;
	}

	public function setDifferentialDiagnosis(DDxElement $differentialDiagnosis): void
	{
		$this->differentialDiagnosis = $differentialDiagnosis;
	}

	public function getDifferentialDiagnosis(): DDxElement
	{
		return $this->differentialDiagnosis;
	}

	public function setAssociatedAnatomy(?AnatomicalSystem $associatedAnatomy): void
	{
		$this->associatedAnatomy = $associatedAnatomy;
	}

	public function getAssociatedAnatomy(): ?AnatomicalSystem
	{
		return $this->associatedAnatomy;
	}

	public function setTypicalTest(MedicalTest $typicalTest): void
	{
		$this->typicalTest = $typicalTest;
	}

	public function getTypicalTest(): MedicalTest
	{
		return $this->typicalTest;
	}
}
