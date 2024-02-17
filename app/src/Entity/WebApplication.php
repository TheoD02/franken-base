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
 * Web applications.
 *
 * @see https://schema.org/WebApplication
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/WebApplication'])]
class WebApplication extends SoftwareApplication
{
	/**
	 * Specifies browser requirements in human-readable text. For example, 'requires HTML5 support'.
	 *
	 * @see https://schema.org/browserRequirements
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/browserRequirements'])]
	private ?string $browserRequirements = null;

	public function setBrowserRequirements(?string $browserRequirements): void
	{
		$this->browserRequirements = $browserRequirements;
	}

	public function getBrowserRequirements(): ?string
	{
		return $this->browserRequirements;
	}
}
