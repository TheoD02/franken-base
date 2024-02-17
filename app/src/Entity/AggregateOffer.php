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
 * When a single product is associated with multiple offers (for example, the same pair of shoes is offered by different merchants), then AggregateOffer can be used.\\n\\nNote: AggregateOffers are normally expected to associate multiple offers that all share the same defined \[\[businessFunction\]\] value, or default to http://purl.org/goodrelations/v1#Sell if businessFunction is not explicitly defined.
 *
 * @see https://schema.org/AggregateOffer
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/AggregateOffer'])]
class AggregateOffer extends Offer
{
	/**
	 * The highest price of all offers available.\\n\\nUsage guidelines:\\n\\n\* Use values from 0123456789 (Unicode 'DIGIT ZERO' (U+0030) to 'DIGIT NINE' (U+0039)) rather than superficially similar Unicode symbols.\\n\* Use '.' (Unicode 'FULL STOP' (U+002E)) rather than ',' to indicate a decimal point. Avoid using these symbols as a readability separator.
	 *
	 * @see https://schema.org/highPrice
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/highPrice'])]
	private ?string $highPrice = null;

	/**
	 * The lowest price of all offers available.\\n\\nUsage guidelines:\\n\\n\* Use values from 0123456789 (Unicode 'DIGIT ZERO' (U+0030) to 'DIGIT NINE' (U+0039)) rather than superficially similar Unicode symbols.\\n\* Use '.' (Unicode 'FULL STOP' (U+002E)) rather than ',' to indicate a decimal point. Avoid using these symbols as a readability separator.
	 *
	 * @see https://schema.org/lowPrice
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/lowPrice'])]
	private ?string $lowPrice = null;

	/**
	 * The number of offers for the product.
	 *
	 * @see https://schema.org/offerCount
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
	#[ApiProperty(types: ['https://schema.org/offerCount'])]
	private ?int $offerCount = null;

	/**
	 * @var Collection<Demand>|null An offer to provide this item—for example, an offer to sell a product, rent the DVD of a movie, perform a service, or give away tickets to an event. Use \[\[businessFunction\]\] to indicate the kind of transaction offered, i.e. sell, lease, etc. This property can also be used to describe a \[\[Demand\]\]. While this property is listed as expected on a number of common types, it can be used in others. In that case, using a second type, such as Product or a subtype of Product, can clarify the nature of the offer.
	 * @see https://schema.org/offers
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Demand')]
	#[ORM\JoinTable(name: 'aggregate_offer_demand_offers')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/offers'])]
	private ?Collection $offers = null;

	function __construct()
	{
		parent::__construct();
		$this->offers = new ArrayCollection();
	}

	public function setHighPrice(?string $highPrice): void
	{
		$this->highPrice = $highPrice;
	}

	public function getHighPrice(): ?string
	{
		return $this->highPrice;
	}

	public function setLowPrice(?string $lowPrice): void
	{
		$this->lowPrice = $lowPrice;
	}

	public function getLowPrice(): ?string
	{
		return $this->lowPrice;
	}

	public function setOfferCount(?int $offerCount): void
	{
		$this->offerCount = $offerCount;
	}

	public function getOfferCount(): ?int
	{
		return $this->offerCount;
	}

	public function addOffer(Demand $offer): void
	{
		$this->offers[] = $offer;
	}

	public function removeOffer(Demand $offer): void
	{
		$this->offers->removeElement($offer);
	}

	/**
	 * @return Collection<Demand>|null
	 */
	public function getOffers(): Collection
	{
		return $this->offers;
	}
}
