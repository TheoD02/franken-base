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
 * A subscription which allows a user to access media including audio, video, books, etc.
 *
 * @see https://schema.org/MediaSubscription
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MediaSubscription'])]
class MediaSubscription extends Intangible
{
	/**
	 * The Organization responsible for authenticating the user's subscription. For example, many media apps require a cable/satellite provider to authenticate your subscription before playing media.
	 *
	 * @see https://schema.org/authenticator
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ApiProperty(types: ['https://schema.org/authenticator'])]
	private ?Organization $authenticator = null;

	/**
	 * An Offer which must be accepted before the user can perform the Action. For example, the user may need to buy a movie before being able to watch it.
	 *
	 * @see https://schema.org/expectsAcceptanceOf
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Offer')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/expectsAcceptanceOf'])]
	#[Assert\NotNull]
	private Offer $expectsAcceptanceOf;

	public function setAuthenticator(?Organization $authenticator): void
	{
		$this->authenticator = $authenticator;
	}

	public function getAuthenticator(): ?Organization
	{
		return $this->authenticator;
	}

	public function setExpectsAcceptanceOf(Offer $expectsAcceptanceOf): void
	{
		$this->expectsAcceptanceOf = $expectsAcceptanceOf;
	}

	public function getExpectsAcceptanceOf(): Offer
	{
		return $this->expectsAcceptanceOf;
	}
}
