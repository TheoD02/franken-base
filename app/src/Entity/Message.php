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
 * A single message from a sender to one or more organizations or people.
 *
 * @see https://schema.org/Message
 */
#[ORM\MappedSuperclass]
abstract class Message extends CreativeWork
{
	/**
	 * A sub property of participant. The participant who is at the sending end of the action.
	 *
	 * @see https://schema.org/sender
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/sender'])]
	#[Assert\NotNull]
	private Organization $sender;

	/**
	 * The date/time at which the message has been read by the recipient if a single recipient exists.
	 *
	 * @see https://schema.org/dateRead
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
	#[ApiProperty(types: ['https://schema.org/dateRead'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $dateRead = null;

	/**
	 * A sub property of recipient. The recipient copied on a message.
	 *
	 * @see https://schema.org/ccRecipient
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/ccRecipient'])]
	#[Assert\NotNull]
	private Organization $ccRecipient;

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
	 * A sub property of recipient. The recipient blind copied on a message.
	 *
	 * @see https://schema.org/bccRecipient
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/bccRecipient'])]
	#[Assert\NotNull]
	private Organization $bccRecipient;

	/**
	 * A sub property of recipient. The recipient who was directly sent the message.
	 *
	 * @see https://schema.org/toRecipient
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/toRecipient'])]
	#[Assert\NotNull]
	private Organization $toRecipient;

	/**
	 * A CreativeWork attached to the message.
	 *
	 * @see https://schema.org/messageAttachment
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWork')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/messageAttachment'])]
	#[Assert\NotNull]
	private CreativeWork $messageAttachment;

	/**
	 * The date/time the message was received if a single recipient exists.
	 *
	 * @see https://schema.org/dateReceived
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\DateTime')]
	#[ApiProperty(types: ['https://schema.org/dateReceived'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $dateReceived = null;

	/**
	 * The date/time at which the message was sent.
	 *
	 * @see https://schema.org/dateSent
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\DateTime')]
	#[ApiProperty(types: ['https://schema.org/dateSent'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $dateSent = null;

	public function setSender(Organization $sender): void
	{
		$this->sender = $sender;
	}

	public function getSender(): Organization
	{
		return $this->sender;
	}

	public function setDateRead(?\DateTimeInterface $dateRead): void
	{
		$this->dateRead = $dateRead;
	}

	public function getDateRead(): ?\DateTimeInterface
	{
		return $this->dateRead;
	}

	public function setCcRecipient(Organization $ccRecipient): void
	{
		$this->ccRecipient = $ccRecipient;
	}

	public function getCcRecipient(): Organization
	{
		return $this->ccRecipient;
	}

	public function setRecipient(Organization $recipient): void
	{
		$this->recipient = $recipient;
	}

	public function getRecipient(): Organization
	{
		return $this->recipient;
	}

	public function setBccRecipient(Organization $bccRecipient): void
	{
		$this->bccRecipient = $bccRecipient;
	}

	public function getBccRecipient(): Organization
	{
		return $this->bccRecipient;
	}

	public function setToRecipient(Organization $toRecipient): void
	{
		$this->toRecipient = $toRecipient;
	}

	public function getToRecipient(): Organization
	{
		return $this->toRecipient;
	}

	public function setMessageAttachment(CreativeWork $messageAttachment): void
	{
		$this->messageAttachment = $messageAttachment;
	}

	public function getMessageAttachment(): CreativeWork
	{
		return $this->messageAttachment;
	}

	public function setDateReceived(?\DateTimeInterface $dateReceived): void
	{
		$this->dateReceived = $dateReceived;
	}

	public function getDateReceived(): ?\DateTimeInterface
	{
		return $this->dateReceived;
	}

	public function setDateSent(?\DateTimeInterface $dateSent): void
	{
		$this->dateSent = $dateSent;
	}

	public function getDateSent(): ?\DateTimeInterface
	{
		return $this->dateSent;
	}
}
