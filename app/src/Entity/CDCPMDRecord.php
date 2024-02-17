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
 * A CDCPMDRecord is a data structure representing a record in a CDC tabular data format used for hospital data reporting. See \[documentation\](/docs/cdc-covid.html) for details, and the linked CDC materials for authoritative definitions used as the source here.
 *
 * @see https://schema.org/CDCPMDRecord
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/CDCPMDRecord'])]
class CDCPMDRecord extends StructuredValue
{
	/**
	 * numtotbeds - ALL HOSPITAL BEDS: Total number of all inpatient and outpatient beds, including all staffed, ICU, licensed, and overflow (surge) beds used for inpatients or outpatients.
	 *
	 * @see https://schema.org/cvdNumTotBeds
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/cvdNumTotBeds'])]
	private ?string $cvdNumTotBeds = null;

	/**
	 * Identifier of the NHSN facility that this data record applies to. Use \[\[cvdFacilityCounty\]\] to indicate the county. To provide other details, \[\[healthcareReportingData\]\] can be used on a \[\[Hospital\]\] entry.
	 *
	 * @see https://schema.org/cvdFacilityId
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/cvdFacilityId'])]
	private ?string $cvdFacilityId = null;

	/**
	 * collectiondate - Date for which patient counts are reported.
	 *
	 * @see https://schema.org/cvdCollectionDate
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\DateTime')]
	#[ApiProperty(types: ['https://schema.org/cvdCollectionDate'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $cvdCollectionDate = null;

	/**
	 * Publication date of an online listing.
	 *
	 * @see https://schema.org/datePosted
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Date')]
	#[ApiProperty(types: ['https://schema.org/datePosted'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $datePosted = null;

	/**
	 * numicubedsocc - ICU BED OCCUPANCY: Total number of staffed inpatient ICU beds that are occupied.
	 *
	 * @see https://schema.org/cvdNumICUBedsOcc
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/cvdNumICUBedsOcc'])]
	private ?string $cvdNumICUBedsOcc = null;

	/**
	 * numc19overflowpats - ED/OVERFLOW: Patients with suspected or confirmed COVID-19 who are in the ED or any overflow location awaiting an inpatient bed.
	 *
	 * @see https://schema.org/cvdNumC19OverflowPats
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/cvdNumC19OverflowPats'])]
	private ?string $cvdNumC19OverflowPats = null;

	/**
	 * numvent - MECHANICAL VENTILATORS: Total number of ventilators available.
	 *
	 * @see https://schema.org/cvdNumVent
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/cvdNumVent'])]
	private ?string $cvdNumVent = null;

	/**
	 * numbeds - HOSPITAL INPATIENT BEDS: Inpatient beds, including all staffed, licensed, and overflow (surge) beds used for inpatients.
	 *
	 * @see https://schema.org/cvdNumBeds
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/cvdNumBeds'])]
	private ?string $cvdNumBeds = null;

	/**
	 * numbedsocc - HOSPITAL INPATIENT BED OCCUPANCY: Total number of staffed inpatient beds that are occupied.
	 *
	 * @see https://schema.org/cvdNumBedsOcc
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/cvdNumBedsOcc'])]
	private ?string $cvdNumBedsOcc = null;

	/**
	 * Name of the County of the NHSN facility that this data record applies to. Use \[\[cvdFacilityId\]\] to identify the facility. To provide other details, \[\[healthcareReportingData\]\] can be used on a \[\[Hospital\]\] entry.
	 *
	 * @see https://schema.org/cvdFacilityCounty
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/cvdFacilityCounty'])]
	private ?string $cvdFacilityCounty = null;

	/**
	 * numc19mechventpats - HOSPITALIZED and VENTILATED: Patients hospitalized in an NHSN inpatient care location who have suspected or confirmed COVID-19 and are on a mechanical ventilator.
	 *
	 * @see https://schema.org/cvdNumC19MechVentPats
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/cvdNumC19MechVentPats'])]
	private ?string $cvdNumC19MechVentPats = null;

	/**
	 * numc19ofmechventpats - ED/OVERFLOW and VENTILATED: Patients with suspected or confirmed COVID-19 who are in the ED or any overflow location awaiting an inpatient bed and on a mechanical ventilator.
	 *
	 * @see https://schema.org/cvdNumC19OFMechVentPats
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/cvdNumC19OFMechVentPats'])]
	private ?string $cvdNumC19OFMechVentPats = null;

	/**
	 * numc19hosppats - HOSPITALIZED: Patients currently hospitalized in an inpatient care location who have suspected or confirmed COVID-19.
	 *
	 * @see https://schema.org/cvdNumC19HospPats
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/cvdNumC19HospPats'])]
	private ?string $cvdNumC19HospPats = null;

	/**
	 * numicubeds - ICU BEDS: Total number of staffed inpatient intensive care unit (ICU) beds.
	 *
	 * @see https://schema.org/cvdNumICUBeds
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/cvdNumICUBeds'])]
	private ?string $cvdNumICUBeds = null;

	/**
	 * numc19hopats - HOSPITAL ONSET: Patients hospitalized in an NHSN inpatient care location with onset of suspected or confirmed COVID-19 14 or more days after hospitalization.
	 *
	 * @see https://schema.org/cvdNumC19HOPats
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/cvdNumC19HOPats'])]
	private ?string $cvdNumC19HOPats = null;

	/**
	 * numc19died - DEATHS: Patients with suspected or confirmed COVID-19 who died in the hospital, ED, or any overflow location.
	 *
	 * @see https://schema.org/cvdNumC19Died
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/cvdNumC19Died'])]
	private ?string $cvdNumC19Died = null;

	/**
	 * numventuse - MECHANICAL VENTILATORS IN USE: Total number of ventilators in use.
	 *
	 * @see https://schema.org/cvdNumVentUse
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/cvdNumVentUse'])]
	private ?string $cvdNumVentUse = null;

	public function setCvdNumTotBeds(?string $cvdNumTotBeds): void
	{
		$this->cvdNumTotBeds = $cvdNumTotBeds;
	}

	public function getCvdNumTotBeds(): ?string
	{
		return $this->cvdNumTotBeds;
	}

	public function setCvdFacilityId(?string $cvdFacilityId): void
	{
		$this->cvdFacilityId = $cvdFacilityId;
	}

	public function getCvdFacilityId(): ?string
	{
		return $this->cvdFacilityId;
	}

	public function setCvdCollectionDate(?\DateTimeInterface $cvdCollectionDate): void
	{
		$this->cvdCollectionDate = $cvdCollectionDate;
	}

	public function getCvdCollectionDate(): ?\DateTimeInterface
	{
		return $this->cvdCollectionDate;
	}

	public function setDatePosted(?\DateTimeInterface $datePosted): void
	{
		$this->datePosted = $datePosted;
	}

	public function getDatePosted(): ?\DateTimeInterface
	{
		return $this->datePosted;
	}

	public function setCvdNumICUBedsOcc(?string $cvdNumICUBedsOcc): void
	{
		$this->cvdNumICUBedsOcc = $cvdNumICUBedsOcc;
	}

	public function getCvdNumICUBedsOcc(): ?string
	{
		return $this->cvdNumICUBedsOcc;
	}

	public function setCvdNumC19OverflowPats(?string $cvdNumC19OverflowPats): void
	{
		$this->cvdNumC19OverflowPats = $cvdNumC19OverflowPats;
	}

	public function getCvdNumC19OverflowPats(): ?string
	{
		return $this->cvdNumC19OverflowPats;
	}

	public function setCvdNumVent(?string $cvdNumVent): void
	{
		$this->cvdNumVent = $cvdNumVent;
	}

	public function getCvdNumVent(): ?string
	{
		return $this->cvdNumVent;
	}

	public function setCvdNumBeds(?string $cvdNumBeds): void
	{
		$this->cvdNumBeds = $cvdNumBeds;
	}

	public function getCvdNumBeds(): ?string
	{
		return $this->cvdNumBeds;
	}

	public function setCvdNumBedsOcc(?string $cvdNumBedsOcc): void
	{
		$this->cvdNumBedsOcc = $cvdNumBedsOcc;
	}

	public function getCvdNumBedsOcc(): ?string
	{
		return $this->cvdNumBedsOcc;
	}

	public function setCvdFacilityCounty(?string $cvdFacilityCounty): void
	{
		$this->cvdFacilityCounty = $cvdFacilityCounty;
	}

	public function getCvdFacilityCounty(): ?string
	{
		return $this->cvdFacilityCounty;
	}

	public function setCvdNumC19MechVentPats(?string $cvdNumC19MechVentPats): void
	{
		$this->cvdNumC19MechVentPats = $cvdNumC19MechVentPats;
	}

	public function getCvdNumC19MechVentPats(): ?string
	{
		return $this->cvdNumC19MechVentPats;
	}

	public function setCvdNumC19OFMechVentPats(?string $cvdNumC19OFMechVentPats): void
	{
		$this->cvdNumC19OFMechVentPats = $cvdNumC19OFMechVentPats;
	}

	public function getCvdNumC19OFMechVentPats(): ?string
	{
		return $this->cvdNumC19OFMechVentPats;
	}

	public function setCvdNumC19HospPats(?string $cvdNumC19HospPats): void
	{
		$this->cvdNumC19HospPats = $cvdNumC19HospPats;
	}

	public function getCvdNumC19HospPats(): ?string
	{
		return $this->cvdNumC19HospPats;
	}

	public function setCvdNumICUBeds(?string $cvdNumICUBeds): void
	{
		$this->cvdNumICUBeds = $cvdNumICUBeds;
	}

	public function getCvdNumICUBeds(): ?string
	{
		return $this->cvdNumICUBeds;
	}

	public function setCvdNumC19HOPats(?string $cvdNumC19HOPats): void
	{
		$this->cvdNumC19HOPats = $cvdNumC19HOPats;
	}

	public function getCvdNumC19HOPats(): ?string
	{
		return $this->cvdNumC19HOPats;
	}

	public function setCvdNumC19Died(?string $cvdNumC19Died): void
	{
		$this->cvdNumC19Died = $cvdNumC19Died;
	}

	public function getCvdNumC19Died(): ?string
	{
		return $this->cvdNumC19Died;
	}

	public function setCvdNumVentUse(?string $cvdNumVentUse): void
	{
		$this->cvdNumVentUse = $cvdNumVentUse;
	}

	public function getCvdNumVentUse(): ?string
	{
		return $this->cvdNumVentUse;
	}
}
