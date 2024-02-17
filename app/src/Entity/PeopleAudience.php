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
use App\Enum\GenderType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A set of characteristics belonging to people, e.g. who compose an item's target audience.
 *
 * @see https://schema.org/PeopleAudience
 */
#[ORM\MappedSuperclass]
abstract class PeopleAudience extends Audience
{
	/**
	 * A suggested range of body measurements for the intended audience or person, for example inseam between 32 and 34 inches or height between 170 and 190 cm. Typically found on a size chart for wearable products.
	 *
	 * @see https://schema.org/suggestedMeasurement
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/suggestedMeasurement'])]
	#[Assert\NotNull]
	private QuantitativeValue $suggestedMeasurement;

	/**
	 * Audiences defined by a person's gender.
	 *
	 * @see https://schema.org/requiredGender
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/requiredGender'])]
	private ?string $requiredGender = null;

	/**
	 * Audiences defined by a person's maximum age.
	 *
	 * @see https://schema.org/requiredMaxAge
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Integer')]
	#[ApiProperty(types: ['https://schema.org/requiredMaxAge'])]
	private ?int $requiredMaxAge = null;

	/**
	 * Minimum recommended age in years for the audience or user.
	 *
	 * @see https://schema.org/suggestedMinAge
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/suggestedMinAge'])]
	private ?string $suggestedMinAge = null;

	/**
	 * Audiences defined by a person's minimum age.
	 *
	 * @see https://schema.org/requiredMinAge
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Integer')]
	#[ApiProperty(types: ['https://schema.org/requiredMinAge'])]
	private ?int $requiredMinAge = null;

	/**
	 * The age or age range for the intended audience or person, for example 3-12 months for infants, 1-5 years for toddlers.
	 *
	 * @see https://schema.org/suggestedAge
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
	#[ApiProperty(types: ['https://schema.org/suggestedAge'])]
	private ?QuantitativeValue $suggestedAge = null;

	/**
	 * The suggested gender of the intended person or audience, for example "male", "female", or "unisex".
	 *
	 * @see https://schema.org/suggestedGender
	 */
	#[ORM\Column(nullable: true)]
	#[ApiProperty(types: ['https://schema.org/suggestedGender'])]
	#[Assert\Choice(callback: [GenderType::class, 'toArray'])]
	private ?string $suggestedGender = null;

	/**
	 * @var Collection<MedicalCondition>|null Specifying the health condition(s) of a patient, medical study, or other target audience.
	 * @see https://schema.org/healthCondition
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\MedicalCondition')]
	#[ORM\JoinTable(name: 'people_audience_medical_condition_health_condition')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/healthCondition'])]
	private ?Collection $healthCondition = null;

	/**
	 * Maximum recommended age in years for the audience or user.
	 *
	 * @see https://schema.org/suggestedMaxAge
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/suggestedMaxAge'])]
	private ?string $suggestedMaxAge = null;

	function __construct()
	{
		$this->healthCondition = new ArrayCollection();
	}

	public function setSuggestedMeasurement(QuantitativeValue $suggestedMeasurement): void
	{
		$this->suggestedMeasurement = $suggestedMeasurement;
	}

	public function getSuggestedMeasurement(): QuantitativeValue
	{
		return $this->suggestedMeasurement;
	}

	public function setRequiredGender(?string $requiredGender): void
	{
		$this->requiredGender = $requiredGender;
	}

	public function getRequiredGender(): ?string
	{
		return $this->requiredGender;
	}

	public function setRequiredMaxAge(?int $requiredMaxAge): void
	{
		$this->requiredMaxAge = $requiredMaxAge;
	}

	public function getRequiredMaxAge(): ?int
	{
		return $this->requiredMaxAge;
	}

	public function setSuggestedMinAge(?string $suggestedMinAge): void
	{
		$this->suggestedMinAge = $suggestedMinAge;
	}

	public function getSuggestedMinAge(): ?string
	{
		return $this->suggestedMinAge;
	}

	public function setRequiredMinAge(?int $requiredMinAge): void
	{
		$this->requiredMinAge = $requiredMinAge;
	}

	public function getRequiredMinAge(): ?int
	{
		return $this->requiredMinAge;
	}

	public function setSuggestedAge(?QuantitativeValue $suggestedAge): void
	{
		$this->suggestedAge = $suggestedAge;
	}

	public function getSuggestedAge(): ?QuantitativeValue
	{
		return $this->suggestedAge;
	}

	public function setSuggestedGender(?string $suggestedGender): void
	{
		$this->suggestedGender = $suggestedGender;
	}

	public function getSuggestedGender(): ?string
	{
		return $this->suggestedGender;
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

	public function setSuggestedMaxAge(?string $suggestedMaxAge): void
	{
		$this->suggestedMaxAge = $suggestedMaxAge;
	}

	public function getSuggestedMaxAge(): ?string
	{
		return $this->suggestedMaxAge;
	}
}
