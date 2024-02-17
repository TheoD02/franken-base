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
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An individual physician or a physician's office considered as a \[\[MedicalOrganization\]\].
 *
 * @see https://schema.org/Physician
 */
#[ORM\MappedSuperclass]
abstract class Physician extends MedicalBusiness
{
	/**
	 * A medical specialty of the provider.
	 *
	 * @see https://schema.org/medicalSpecialty
	 */
	#[ORM\Column]
	#[ApiProperty(types: ['https://schema.org/medicalSpecialty'])]
	#[Assert\NotNull]
	#[Assert\Choice(callback: [MedicalSpecialty::class, 'toArray'])]
	private string $medicalSpecialty;

	/**
	 * A category describing the job, preferably using a term from a taxonomy such as \[BLS O\*NET-SOC\](http://www.onetcenter.org/taxonomy.html), \[ISCO-08\](https://www.ilo.org/public/english/bureau/stat/isco/isco08/) or similar, with the property repeated for each applicable value. Ideally the taxonomy should be identified, and both the textual label and formal code for the category should be provided.\\n Note: for historical reasons, any textual label and formal code provided as a literal may be assumed to be from O\*NET-SOC.
	 *
	 * @see https://schema.org/occupationalCategory
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/occupationalCategory'])]
	private ?string $occupationalCategory = null;

	/**
	 * A hospital with which the physician or office is affiliated.
	 *
	 * @see https://schema.org/hospitalAffiliation
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Hospital')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/hospitalAffiliation'])]
	#[Assert\NotNull]
	private Hospital $hospitalAffiliation;

	/**
	 * A [National Provider Identifier](https://en.wikipedia.org/wiki/National_Provider_Identifier) (NPI) is a unique 10-digit identification number issued to health care providers in the United States by the Centers for Medicare and Medicaid Services.
	 *
	 * @see https://schema.org/usNPI
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/usNPI'])]
	private ?string $usNPI = null;

	/**
	 * A medical service available from this provider.
	 *
	 * @see https://schema.org/availableService
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MedicalTest')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/availableService'])]
	#[Assert\NotNull]
	private MedicalTest $availableService;

	public function setMedicalSpecialty(string $medicalSpecialty): void
	{
		$this->medicalSpecialty = $medicalSpecialty;
	}

	public function getMedicalSpecialty(): string
	{
		return $this->medicalSpecialty;
	}

	public function setOccupationalCategory(?string $occupationalCategory): void
	{
		$this->occupationalCategory = $occupationalCategory;
	}

	public function getOccupationalCategory(): ?string
	{
		return $this->occupationalCategory;
	}

	public function setHospitalAffiliation(Hospital $hospitalAffiliation): void
	{
		$this->hospitalAffiliation = $hospitalAffiliation;
	}

	public function getHospitalAffiliation(): Hospital
	{
		return $this->hospitalAffiliation;
	}

	public function setUsNPI(?string $usNPI): void
	{
		$this->usNPI = $usNPI;
	}

	public function getUsNPI(): ?string
	{
		return $this->usNPI;
	}

	public function setAvailableService(MedicalTest $availableService): void
	{
		$this->availableService = $availableService;
	}

	public function getAvailableService(): MedicalTest
	{
		return $this->availableService;
	}
}
