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
 * The price for the delivery of an offer using a particular delivery method.
 *
 * @see https://schema.org/DeliveryChargeSpecification
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DeliveryChargeSpecification'])]
class DeliveryChargeSpecification extends PriceSpecification
{
	/**
	 * @var Collection<Text>|null The ISO 3166-1 (ISO 3166-1 alpha-2) or ISO 3166-2 code, the place, or the GeoShape for the geo-political region(s) for which the offer or delivery charge specification is not valid, e.g. a region where the transaction is not allowed.\\n\\nSee also \[\[eligibleRegion\]\].
	 * @see https://schema.org/ineligibleRegion
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinTable(name: 'delivery_charge_specification_text_ineligible_region')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/ineligibleRegion'])]
	private ?Collection $ineligibleRegion = null;

	/**
	 * @var Collection<GeoShape>|null The ISO 3166-1 (ISO 3166-1 alpha-2) or ISO 3166-2 code, the place, or the GeoShape for the geo-political region(s) for which the offer or delivery charge specification is valid.\\n\\nSee also \[\[ineligibleRegion\]\].
	 * @see https://schema.org/eligibleRegion
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\GeoShape')]
	#[ORM\JoinTable(name: 'delivery_charge_specification_geo_shape_eligible_region')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/eligibleRegion'])]
	private ?Collection $eligibleRegion = null;

	/**
	 * The geographic area where a service or offered item is provided.
	 *
	 * @see https://schema.org/areaServed
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/areaServed'])]
	private ?string $areaServed = null;

	/**
	 * @var string[]|null The delivery method(s) to which the delivery charge or payment charge specification applies.
	 * @see https://schema.org/appliesToDeliveryMethod
	 */
	#[ORM\Column(type: 'simple_array', nullable: true)]
	#[ApiProperty(types: ['https://schema.org/appliesToDeliveryMethod'])]
	#[Assert\Choice(callback: [DeliveryMethod::class, 'toArray'], multiple: true)]
	private ?Collection $appliesToDeliveryMethod = null;

	function __construct()
	{
		$this->ineligibleRegion = new ArrayCollection();
		$this->eligibleRegion = new ArrayCollection();
	}

	public function addIneligibleRegion(string $ineligibleRegion): void
	{
		$this->ineligibleRegion[] = $ineligibleRegion;
	}

	public function removeIneligibleRegion(string $ineligibleRegion): void
	{
		$this->ineligibleRegion->removeElement($ineligibleRegion);
	}

	/**
	 * @return Collection<Text>|null
	 */
	public function getIneligibleRegion(): Collection
	{
		return $this->ineligibleRegion;
	}

	public function addEligibleRegion(GeoShape $eligibleRegion): void
	{
		$this->eligibleRegion[] = $eligibleRegion;
	}

	public function removeEligibleRegion(GeoShape $eligibleRegion): void
	{
		$this->eligibleRegion->removeElement($eligibleRegion);
	}

	/**
	 * @return Collection<GeoShape>|null
	 */
	public function getEligibleRegion(): Collection
	{
		return $this->eligibleRegion;
	}

	public function setAreaServed(?string $areaServed): void
	{
		$this->areaServed = $areaServed;
	}

	public function getAreaServed(): ?string
	{
		return $this->areaServed;
	}

	public function addAppliesToDeliveryMethod($appliesToDeliveryMethod): void
	{
		$this->appliesToDeliveryMethod[] = (string) $appliesToDeliveryMethod;
	}

	public function removeAppliesToDeliveryMethod(string $appliesToDeliveryMethod): void
	{
		if (false !== $key = array_search((string)$appliesToDeliveryMethod, $this->appliesToDeliveryMethod ?? [], true)) {
		    unset($this->appliesToDeliveryMethod[$key]);
		}
	}

	/**
	 * @return string[]|null
	 */
	public function getAppliesToDeliveryMethod(): Collection
	{
		return $this->appliesToDeliveryMethod;
	}
}
