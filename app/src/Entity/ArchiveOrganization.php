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
 * An organization with archival holdings. An organization which keeps and preserves archival material and typically makes it accessible to the public.
 *
 * @see https://schema.org/ArchiveOrganization
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ArchiveOrganization'])]
class ArchiveOrganization extends LocalBusiness
{
	/**
	 * Collection, \[fonds\](https://en.wikipedia.org/wiki/Fonds), or item held, kept or maintained by an \[\[ArchiveOrganization\]\].
	 *
	 * @see https://schema.org/archiveHeld
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\ArchiveComponent')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/archiveHeld'])]
	#[Assert\NotNull]
	private ArchiveComponent $archiveHeld;

	public function setArchiveHeld(ArchiveComponent $archiveHeld): void
	{
		$this->archiveHeld = $archiveHeld;
	}

	public function getArchiveHeld(): ArchiveComponent
	{
		return $this->archiveHeld;
	}
}
