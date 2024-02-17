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
use App\Enum\DigitalDocumentPermissionType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A permission for a particular person or group to access a particular file.
 *
 * @see https://schema.org/DigitalDocumentPermission
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DigitalDocumentPermission'])]
class DigitalDocumentPermission extends Intangible
{
	/**
	 * The type of permission granted the person, organization, or audience.
	 *
	 * @see https://schema.org/permissionType
	 */
	#[ORM\Column(nullable: true)]
	#[ApiProperty(types: ['https://schema.org/permissionType'])]
	#[Assert\Choice(callback: [DigitalDocumentPermissionType::class, 'toArray'])]
	private ?string $permissionType = null;

	/**
	 * The person, organization, contact point, or audience that has been granted this permission.
	 *
	 * @see https://schema.org/grantee
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Audience')]
	#[ApiProperty(types: ['https://schema.org/grantee'])]
	private ?Audience $grantee = null;

	public function setPermissionType(?string $permissionType): void
	{
		$this->permissionType = $permissionType;
	}

	public function getPermissionType(): ?string
	{
		return $this->permissionType;
	}

	public function setGrantee(?Audience $grantee): void
	{
		$this->grantee = $grantee;
	}

	public function getGrantee(): ?Audience
	{
		return $this->grantee;
	}
}
