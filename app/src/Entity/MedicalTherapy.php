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
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Any medical intervention designed to prevent, treat, and cure human diseases and medical conditions, including both curative and palliative therapies. Medical therapies are typically processes of care relying upon pharmacotherapy, behavioral therapy, supportive therapy (with fluid or nutrition for example), or detoxification (e.g. hemodialysis) aimed at improving or preventing a health condition.
 *
 * @see https://schema.org/MedicalTherapy
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
	'medicalTherapy' => MedicalTherapy::class,
	'radiationTherapy' => RadiationTherapy::class,
	'occupationalTherapy' => OccupationalTherapy::class,
	'physicalTherapy' => PhysicalTherapy::class,
	'palliativeProcedure' => PalliativeProcedure::class,
])]
class MedicalTherapy extends TherapeuticProcedure
{
	/**
	 * A contraindication for this therapy.
	 *
	 * @see https://schema.org/contraindication
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/contraindication'])]
	private ?string $contraindication = null;

	/**
	 * A possible serious complication and/or serious side effect of this therapy. Serious adverse outcomes include those that are life-threatening; result in death, disability, or permanent damage; require hospitalization or prolong existing hospitalization; cause congenital anomalies or birth defects; or jeopardize the patient and may require medical or surgical intervention to prevent one of the outcomes in this definition.
	 *
	 * @see https://schema.org/seriousAdverseOutcome
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MedicalEntity')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/seriousAdverseOutcome'])]
	#[Assert\NotNull]
	private MedicalEntity $seriousAdverseOutcome;

	/**
	 * A therapy that duplicates or overlaps this one.
	 *
	 * @see https://schema.org/duplicateTherapy
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MedicalTherapy')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/duplicateTherapy'])]
	#[Assert\NotNull]
	private MedicalTherapy $duplicateTherapy;

	public function setContraindication(?string $contraindication): void
	{
		$this->contraindication = $contraindication;
	}

	public function getContraindication(): ?string
	{
		return $this->contraindication;
	}

	public function setSeriousAdverseOutcome(MedicalEntity $seriousAdverseOutcome): void
	{
		$this->seriousAdverseOutcome = $seriousAdverseOutcome;
	}

	public function getSeriousAdverseOutcome(): MedicalEntity
	{
		return $this->seriousAdverseOutcome;
	}

	public function setDuplicateTherapy(MedicalTherapy $duplicateTherapy): void
	{
		$this->duplicateTherapy = $duplicateTherapy;
	}

	public function getDuplicateTherapy(): MedicalTherapy
	{
		return $this->duplicateTherapy;
	}
}
