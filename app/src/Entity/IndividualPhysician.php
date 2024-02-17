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
 * An individual medical practitioner. For their official address use \[\[address\]\], for affiliations to hospitals use \[\[hospitalAffiliation\]\]. The \[\[practicesAt\]\] property can be used to indicate \[\[MedicalOrganization\]\] hospitals, clinics, pharmacies etc. where this physician practices.
 *
 * @see https://schema.org/IndividualPhysician
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/IndividualPhysician'])]
class IndividualPhysician extends Physician
{
	/**
	 * A \[\[MedicalOrganization\]\] where the \[\[IndividualPhysician\]\] practices.
	 *
	 * @see https://schema.org/practicesAt
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MedicalOrganization')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/practicesAt'])]
	#[Assert\NotNull]
	private MedicalOrganization $practicesAt;

	public function setPracticesAt(MedicalOrganization $practicesAt): void
	{
		$this->practicesAt = $practicesAt;
	}

	public function getPracticesAt(): MedicalOrganization
	{
		return $this->practicesAt;
	}
}
