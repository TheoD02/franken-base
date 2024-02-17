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
use App\Enum\DeliveryMethod;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An event involving the delivery of an item.
 *
 * @see https://schema.org/DeliveryEvent
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DeliveryEvent'])]
class DeliveryEvent extends Event
{
	/**
	 * Password, PIN, or access code needed for delivery (e.g. from a locker).
	 *
	 * @see https://schema.org/accessCode
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/accessCode'])]
	private ?string $accessCode = null;

	/**
	 * When the item is available for pickup from the store, locker, etc.
	 *
	 * @see https://schema.org/availableFrom
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\DateTime')]
	#[ApiProperty(types: ['https://schema.org/availableFrom'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $availableFrom = null;

	/**
	 * After this date, the item will no longer be available for pickup.
	 *
	 * @see https://schema.org/availableThrough
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\DateTime')]
	#[ApiProperty(types: ['https://schema.org/availableThrough'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $availableThrough = null;

	/**
	 * Method used for delivery or shipping.
	 *
	 * @see https://schema.org/hasDeliveryMethod
	 */
	#[ORM\Column]
	#[ApiProperty(types: ['https://schema.org/hasDeliveryMethod'])]
	#[Assert\NotNull]
	#[Assert\Choice(callback: [DeliveryMethod::class, 'toArray'])]
	private string $hasDeliveryMethod;

	public function setAccessCode(?string $accessCode): void
	{
		$this->accessCode = $accessCode;
	}

	public function getAccessCode(): ?string
	{
		return $this->accessCode;
	}

	public function setAvailableFrom(?\DateTimeInterface $availableFrom): void
	{
		$this->availableFrom = $availableFrom;
	}

	public function getAvailableFrom(): ?\DateTimeInterface
	{
		return $this->availableFrom;
	}

	public function setAvailableThrough(?\DateTimeInterface $availableThrough): void
	{
		$this->availableThrough = $availableThrough;
	}

	public function getAvailableThrough(): ?\DateTimeInterface
	{
		return $this->availableThrough;
	}

	public function setHasDeliveryMethod(string $hasDeliveryMethod): void
	{
		$this->hasDeliveryMethod = $hasDeliveryMethod;
	}

	public function getHasDeliveryMethod(): string
	{
		return $this->hasDeliveryMethod;
	}
}
