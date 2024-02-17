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
 * The act of conveying information to another person via a communication medium (instrument) such as speech, email, or telephone conversation.
 *
 * @see https://schema.org/CommunicateAction
 */
#[ORM\MappedSuperclass]
abstract class CommunicateAction extends InteractAction
{
	/**
	 * The language of the content or performance or used in an action. Please use one of the language codes from the \[IETF BCP 47 standard\](http://tools.ietf.org/html/bcp47). See also \[\[availableLanguage\]\].
	 *
	 * @see https://schema.org/inLanguage
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/inLanguage'])]
	private ?string $inLanguage = null;

	/**
	 * A sub property of participant. The participant who is at the receiving end of the action.
	 *
	 * @see https://schema.org/recipient
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/recipient'])]
	#[Assert\NotNull]
	private Organization $recipient;

	/**
	 * The subject matter of the content.
	 *
	 * @see https://schema.org/about
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Thing')]
	#[ApiProperty(types: ['https://schema.org/about'])]
	private ?Thing $about = null;

	public function setInLanguage(?string $inLanguage): void
	{
		$this->inLanguage = $inLanguage;
	}

	public function getInLanguage(): ?string
	{
		return $this->inLanguage;
	}

	public function setRecipient(Organization $recipient): void
	{
		$this->recipient = $recipient;
	}

	public function getRecipient(): Organization
	{
		return $this->recipient;
	}

	public function setAbout(?Thing $about): void
	{
		$this->about = $about;
	}

	public function getAbout(): ?Thing
	{
		return $this->about;
	}
}
