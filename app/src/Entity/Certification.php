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
use App\Enum\CertificationStatusEnumeration;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A Certification is an official and authoritative statement about a subject, for example a product, service, person, or organization. A certification is typically issued by an indendent certification body, for example a professional organization or government. It formally attests certain characteristics about the subject, for example Organizations can be ISO certified, Food products can be certified Organic or Vegan, a Person can be a certified professional, a Place can be certified for food processing. There are certifications for many domains: regulatory, organizational, recycling, food, efficiency, educational, ecological, etc. A certification is a form of credential, as are accreditations and licenses. Mapped from the \[gs1:CertificationDetails\](https://www.gs1.org/voc/CertificationDetails) class in the GS1 Web Vocabulary.
 *
 * @see https://schema.org/Certification
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Certification'])]
class Certification extends CreativeWork
{
	/**
	 * Indicates the current status of a certification: active or inactive. See also \[gs1:certificationStatus\](https://www.gs1.org/voc/certificationStatus).
	 *
	 * @see https://schema.org/certificationStatus
	 */
	#[ORM\Column]
	#[ApiProperty(types: ['https://schema.org/certificationStatus'])]
	#[Assert\NotNull]
	#[Assert\Choice(callback: [CertificationStatusEnumeration::class, 'toArray'])]
	private string $certificationStatus;

	/**
	 * A measurement of an item, For example, the inseam of pants, the wheel size of a bicycle, the gauge of a screw, or the carbon footprint measured for certification by an authority. Usually an exact measurement, but can also be a range of measurements for adjustable products, for example belts and ski bindings.
	 *
	 * @see https://schema.org/hasMeasurement
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/hasMeasurement'])]
	#[Assert\NotNull]
	private QuantitativeValue $hasMeasurement;

	/**
	 * An associated logo.
	 *
	 * @see https://schema.org/logo
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/logo'])]
	#[Assert\Url]
	private ?string $logo = null;

	/**
	 * Date when a certification was last audited. See also \[gs1:certificationAuditDate\](https://www.gs1.org/voc/certificationAuditDate).
	 *
	 * @see https://schema.org/auditDate
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\DateTime')]
	#[ApiProperty(types: ['https://schema.org/auditDate'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $auditDate = null;

	/**
	 * Identifier of a certification instance (as registered with an independent certification body). Typically this identifier can be used to consult and verify the certification instance. See also \[gs1:certificationIdentification\](https://www.gs1.org/voc/certificationIdentification).
	 *
	 * @see https://schema.org/certificationIdentification
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\DefinedTerm')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/certificationIdentification'])]
	#[Assert\NotNull]
	private DefinedTerm $certificationIdentification;

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

	public function setCertificationStatus(string $certificationStatus): void
	{
		$this->certificationStatus = $certificationStatus;
	}

	public function getCertificationStatus(): string
	{
		return $this->certificationStatus;
	}

	public function setHasMeasurement(QuantitativeValue $hasMeasurement): void
	{
		$this->hasMeasurement = $hasMeasurement;
	}

	public function getHasMeasurement(): QuantitativeValue
	{
		return $this->hasMeasurement;
	}

	public function setLogo(?string $logo): void
	{
		$this->logo = $logo;
	}

	public function getLogo(): ?string
	{
		return $this->logo;
	}

	public function setAuditDate(?\DateTimeInterface $auditDate): void
	{
		$this->auditDate = $auditDate;
	}

	public function getAuditDate(): ?\DateTimeInterface
	{
		return $this->auditDate;
	}

	public function setCertificationIdentification(DefinedTerm $certificationIdentification): void
	{
		$this->certificationIdentification = $certificationIdentification;
	}

	public function getCertificationIdentification(): DefinedTerm
	{
		return $this->certificationIdentification;
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
