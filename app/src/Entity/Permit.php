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
 * A permit issued by an organization, e.g. a parking pass.
 *
 * @see https://schema.org/Permit
 */
#[ORM\MappedSuperclass]
abstract class Permit extends Intangible
{
	/**
	 * The service through which the permit was granted.
	 *
	 * @see https://schema.org/issuedThrough
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Service')]
	#[ApiProperty(types: ['https://schema.org/issuedThrough'])]
	private ?Service $issuedThrough = null;

	/**
	 * The date when the item is no longer valid.
	 *
	 * @see https://schema.org/validUntil
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
	#[ApiProperty(types: ['https://schema.org/validUntil'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $validUntil = null;

	/**
	 * The duration of validity of a permit or similar thing.
	 *
	 * @see https://schema.org/validFor
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Duration')]
	#[ApiProperty(types: ['https://schema.org/validFor'])]
	private ?Duration $validFor = null;

	/**
	 * The target audience for this permit.
	 *
	 * @see https://schema.org/permitAudience
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Audience')]
	#[ApiProperty(types: ['https://schema.org/permitAudience'])]
	private ?Audience $permitAudience = null;

	/**
	 * The organization issuing the item, for example a \[\[Permit\]\], \[\[Ticket\]\], or \[\[Certification\]\].
	 *
	 * @see https://schema.org/issuedBy
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ApiProperty(types: ['https://schema.org/issuedBy'])]
	private ?Organization $issuedBy = null;

	/**
	 * The geographic area where the item is valid. Applies for example to a \[\[Permit\]\], a \[\[Certification\]\], or an \[\[EducationalOccupationalCredential\]\].
	 *
	 * @see https://schema.org/validIn
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\AdministrativeArea')]
	#[ApiProperty(types: ['https://schema.org/validIn'])]
	private ?AdministrativeArea $validIn = null;

	/**
	 * The date when the item becomes valid.
	 *
	 * @see https://schema.org/validFrom
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
	#[ApiProperty(types: ['https://schema.org/validFrom'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $validFrom = null;

	public function setIssuedThrough(?Service $issuedThrough): void
	{
		$this->issuedThrough = $issuedThrough;
	}

	public function getIssuedThrough(): ?Service
	{
		return $this->issuedThrough;
	}

	public function setValidUntil(?\DateTimeInterface $validUntil): void
	{
		$this->validUntil = $validUntil;
	}

	public function getValidUntil(): ?\DateTimeInterface
	{
		return $this->validUntil;
	}

	public function setValidFor(?Duration $validFor): void
	{
		$this->validFor = $validFor;
	}

	public function getValidFor(): ?Duration
	{
		return $this->validFor;
	}

	public function setPermitAudience(?Audience $permitAudience): void
	{
		$this->permitAudience = $permitAudience;
	}

	public function getPermitAudience(): ?Audience
	{
		return $this->permitAudience;
	}

	public function setIssuedBy(?Organization $issuedBy): void
	{
		$this->issuedBy = $issuedBy;
	}

	public function getIssuedBy(): ?Organization
	{
		return $this->issuedBy;
	}

	public function setValidIn(?AdministrativeArea $validIn): void
	{
		$this->validIn = $validIn;
	}

	public function getValidIn(): ?AdministrativeArea
	{
		return $this->validIn;
	}

	public function setValidFrom(?\DateTimeInterface $validFrom): void
	{
		$this->validFrom = $validFrom;
	}

	public function getValidFrom(): ?\DateTimeInterface
	{
		return $this->validFrom;
	}
}
