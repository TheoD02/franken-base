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
 * Intended audience for an item, i.e. the group for whom the item was created.
 *
 * @see https://schema.org/Audience
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
	'audience' => Audience::class,
	'researcher' => Researcher::class,
	'educationalAudience' => EducationalAudience::class,
	'businessAudience' => BusinessAudience::class,
	'medicalAudience' => MedicalAudience::class,
	'parentAudience' => ParentAudience::class,
])]
class Audience extends Intangible
{
	/**
	 * The target group associated with a given audience (e.g. veterans, car owners, musicians, etc.).
	 *
	 * @see https://schema.org/audienceType
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/audienceType'])]
	private ?string $audienceType = null;

	/**
	 * The geographic area associated with the audience.
	 *
	 * @see https://schema.org/geographicArea
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\AdministrativeArea')]
	#[ApiProperty(types: ['https://schema.org/geographicArea'])]
	private ?AdministrativeArea $geographicArea = null;

	public function setAudienceType(?string $audienceType): void
	{
		$this->audienceType = $audienceType;
	}

	public function getAudienceType(): ?string
	{
		return $this->audienceType;
	}

	public function setGeographicArea(?AdministrativeArea $geographicArea): void
	{
		$this->geographicArea = $geographicArea;
	}

	public function getGeographicArea(): ?AdministrativeArea
	{
		return $this->geographicArea;
	}
}
