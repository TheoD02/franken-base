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
 * An alternative, closely-related condition typically considered later in the differential diagnosis process along with the signs that are used to distinguish it.
 *
 * @see https://schema.org/DDxElement
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DDxElement'])]
class DDxElement extends MedicalIntangible
{
	/**
	 * @var Collection<MedicalCondition>|null One or more alternative conditions considered in the differential diagnosis process as output of a diagnosis process.
	 * @see https://schema.org/diagnosis
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\MedicalCondition')]
	#[ORM\JoinTable(name: 'd_dx_element_medical_condition_diagnosis')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/diagnosis'])]
	private ?Collection $diagnosis = null;

	/**
	 * One of a set of signs and symptoms that can be used to distinguish this diagnosis from others in the differential diagnosis.
	 *
	 * @see https://schema.org/distinguishingSign
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MedicalSignOrSymptom')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/distinguishingSign'])]
	#[Assert\NotNull]
	private MedicalSignOrSymptom $distinguishingSign;

	function __construct()
	{
		$this->diagnosis = new ArrayCollection();
	}

	public function addDiagnosi(MedicalCondition $diagnosi): void
	{
		$this->diagnosis[] = $diagnosi;
	}

	public function removeDiagnosi(MedicalCondition $diagnosi): void
	{
		$this->diagnosis->removeElement($diagnosi);
	}

	/**
	 * @return Collection<MedicalCondition>|null
	 */
	public function getDiagnosis(): Collection
	{
		return $this->diagnosis;
	}

	public function setDistinguishingSign(MedicalSignOrSymptom $distinguishingSign): void
	{
		$this->distinguishingSign = $distinguishingSign;
	}

	public function getDistinguishingSign(): MedicalSignOrSymptom
	{
		return $this->distinguishingSign;
	}
}
