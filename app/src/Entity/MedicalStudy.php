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
 * A medical study is an umbrella type covering all kinds of research studies relating to human medicine or health, including observational studies and interventional trials and registries, randomized, controlled or not. When the specific type of study is known, use one of the extensions of this type, such as MedicalTrial or MedicalObservationalStudy. Also, note that this type should be used to mark up data that describes the study itself; to tag an article that publishes the results of a study, use MedicalScholarlyArticle. Note: use the code property of MedicalEntity to store study IDs, e.g. clinicaltrials.gov ID.
 *
 * @see https://schema.org/MedicalStudy
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
	'medicalStudy' => MedicalStudy::class,
	'medicalTrial' => MedicalTrial::class,
	'medicalObservationalStudy' => MedicalObservationalStudy::class,
])]
class MedicalStudy extends MedicalEntity
{
	/**
	 * A person or organization that supports a thing through a pledge, promise, or financial contribution. E.g. a sponsor of a Medical Study or a corporate sponsor of an event.
	 *
	 * @see https://schema.org/sponsor
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/sponsor'])]
	#[Assert\NotNull]
	private Organization $sponsor;

	/**
	 * A subject of the study, i.e. one of the medical conditions, therapies, devices, drugs, etc. investigated by the study.
	 *
	 * @see https://schema.org/studySubject
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MedicalEntity')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/studySubject'])]
	#[Assert\NotNull]
	private MedicalEntity $studySubject;

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
	 * The location in which the study is taking/took place.
	 *
	 * @see https://schema.org/studyLocation
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\AdministrativeArea')]
	#[ApiProperty(types: ['https://schema.org/studyLocation'])]
	private ?AdministrativeArea $studyLocation = null;

	/**
	 * @var Collection<MedicalCondition>|null Specifying the health condition(s) of a patient, medical study, or other target audience.
	 * @see https://schema.org/healthCondition
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\MedicalCondition')]
	#[ORM\JoinTable(name: 'medical_study_medical_condition_health_condition')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/healthCondition'])]
	private ?Collection $healthCondition = null;

	function __construct()
	{
		$this->healthCondition = new ArrayCollection();
	}

	public function setSponsor(Organization $sponsor): void
	{
		$this->sponsor = $sponsor;
	}

	public function getSponsor(): Organization
	{
		return $this->sponsor;
	}

	public function setStudySubject(MedicalEntity $studySubject): void
	{
		$this->studySubject = $studySubject;
	}

	public function getStudySubject(): MedicalEntity
	{
		return $this->studySubject;
	}

	public function setStatus(?string $status): void
	{
		$this->status = $status;
	}

	public function getStatus(): ?string
	{
		return $this->status;
	}

	public function setStudyLocation(?AdministrativeArea $studyLocation): void
	{
		$this->studyLocation = $studyLocation;
	}

	public function getStudyLocation(): ?AdministrativeArea
	{
		return $this->studyLocation;
	}

	public function addHealthCondition(MedicalCondition $healthCondition): void
	{
		$this->healthCondition[] = $healthCondition;
	}

	public function removeHealthCondition(MedicalCondition $healthCondition): void
	{
		$this->healthCondition->removeElement($healthCondition);
	}

	/**
	 * @return Collection<MedicalCondition>|null
	 */
	public function getHealthCondition(): Collection
	{
		return $this->healthCondition;
	}
}
