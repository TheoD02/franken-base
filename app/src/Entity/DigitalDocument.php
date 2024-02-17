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
 * An electronic file or document.
 *
 * @see https://schema.org/DigitalDocument
 */
#[ORM\MappedSuperclass]
abstract class DigitalDocument extends CreativeWork
{
	/**
	 * A permission related to the access to this document (e.g. permission to read or write an electronic document). For a public document, specify a grantee with an Audience with audienceType equal to "public".
	 *
	 * @see https://schema.org/hasDigitalDocumentPermission
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\DigitalDocumentPermission')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/hasDigitalDocumentPermission'])]
	#[Assert\NotNull]
	private DigitalDocumentPermission $hasDigitalDocumentPermission;

	public function setHasDigitalDocumentPermission(DigitalDocumentPermission $hasDigitalDocumentPermission): void
	{
		$this->hasDigitalDocumentPermission = $hasDigitalDocumentPermission;
	}

	public function getHasDigitalDocumentPermission(): DigitalDocumentPermission
	{
		return $this->hasDigitalDocumentPermission;
	}
}
