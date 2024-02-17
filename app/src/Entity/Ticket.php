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
 * Used to describe a ticket to an event, a flight, a bus ride, etc.
 *
 * @see https://schema.org/Ticket
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Ticket'])]
class Ticket extends Intangible
{
	/**
	 * The currency of the price, or a price component when attached to \[\[PriceSpecification\]\] and its subtypes.\\n\\nUse standard formats: \[ISO 4217 currency format\](http://en.wikipedia.org/wiki/ISO\_4217), e.g. "USD"; \[Ticker symbol\](https://en.wikipedia.org/wiki/List\_of\_cryptocurrencies) for cryptocurrencies, e.g. "BTC"; well known names for \[Local Exchange Trading Systems\](https://en.wikipedia.org/wiki/Local\_exchange\_trading\_system) (LETS) and other currency types, e.g. "Ithaca HOUR".
	 *
	 * @see https://schema.org/priceCurrency
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/priceCurrency'])]
	#[Assert\NotNull]
	private string $priceCurrency;

	/**
	 * The unique identifier for the ticket.
	 *
	 * @see https://schema.org/ticketNumber
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/ticketNumber'])]
	private ?string $ticketNumber = null;

	/**
	 * Reference to an asset (e.g., Barcode, QR code image or PDF) usable for entrance.
	 *
	 * @see https://schema.org/ticketToken
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/ticketToken'])]
	private ?string $ticketToken = null;

	/**
	 * The person or organization the reservation or ticket is for.
	 *
	 * @see https://schema.org/underName
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ApiProperty(types: ['https://schema.org/underName'])]
	private ?Organization $underName = null;

	/**
	 * The organization issuing the item, for example a \[\[Permit\]\], \[\[Ticket\]\], or \[\[Certification\]\].
	 *
	 * @see https://schema.org/issuedBy
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ApiProperty(types: ['https://schema.org/issuedBy'])]
	private ?Organization $issuedBy = null;

	/**
	 * The seat associated with the ticket.
	 *
	 * @see https://schema.org/ticketedSeat
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Seat')]
	#[ApiProperty(types: ['https://schema.org/ticketedSeat'])]
	private ?Seat $ticketedSeat = null;

	/**
	 * The date the ticket was issued.
	 *
	 * @see https://schema.org/dateIssued
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
	#[ApiProperty(types: ['https://schema.org/dateIssued'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $dateIssued = null;

	/**
	 * The total price for the reservation or ticket, including applicable taxes, shipping, etc.\\n\\nUsage guidelines:\\n\\n\* Use values from 0123456789 (Unicode 'DIGIT ZERO' (U+0030) to 'DIGIT NINE' (U+0039)) rather than superficially similar Unicode symbols.\\n\* Use '.' (Unicode 'FULL STOP' (U+002E)) rather than ',' to indicate a decimal point. Avoid using these symbols as a readability separator.
	 *
	 * @see https://schema.org/totalPrice
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\PriceSpecification')]
	#[ApiProperty(types: ['https://schema.org/totalPrice'])]
	private ?PriceSpecification $totalPrice = null;

	public function setPriceCurrency(string $priceCurrency): void
	{
		$this->priceCurrency = $priceCurrency;
	}

	public function getPriceCurrency(): string
	{
		return $this->priceCurrency;
	}

	public function setTicketNumber(?string $ticketNumber): void
	{
		$this->ticketNumber = $ticketNumber;
	}

	public function getTicketNumber(): ?string
	{
		return $this->ticketNumber;
	}

	public function setTicketToken(?string $ticketToken): void
	{
		$this->ticketToken = $ticketToken;
	}

	public function getTicketToken(): ?string
	{
		return $this->ticketToken;
	}

	public function setUnderName(?Organization $underName): void
	{
		$this->underName = $underName;
	}

	public function getUnderName(): ?Organization
	{
		return $this->underName;
	}

	public function setIssuedBy(?Organization $issuedBy): void
	{
		$this->issuedBy = $issuedBy;
	}

	public function getIssuedBy(): ?Organization
	{
		return $this->issuedBy;
	}

	public function setTicketedSeat(?Seat $ticketedSeat): void
	{
		$this->ticketedSeat = $ticketedSeat;
	}

	public function getTicketedSeat(): ?Seat
	{
		return $this->ticketedSeat;
	}

	public function setDateIssued(?\DateTimeInterface $dateIssued): void
	{
		$this->dateIssued = $dateIssued;
	}

	public function getDateIssued(): ?\DateTimeInterface
	{
		return $this->dateIssued;
	}

	public function setTotalPrice(?PriceSpecification $totalPrice): void
	{
		$this->totalPrice = $totalPrice;
	}

	public function getTotalPrice(): ?PriceSpecification
	{
		return $this->totalPrice;
	}
}
