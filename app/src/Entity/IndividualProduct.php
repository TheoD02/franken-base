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
 * A single, identifiable product instance (e.g. a laptop with a particular serial number).
 *
 * @see https://schema.org/IndividualProduct
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/IndividualProduct'])]
class IndividualProduct extends Product
{
	/**
	 * @var Collection<Text>|null The serial number or any alphanumeric identifier of a particular product. When attached to an offer, it is a shortcut for the serial number of the product included in the offer.
	 * @see https://schema.org/serialNumber
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinTable(name: 'individual_product_text_serial_number')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/serialNumber'])]
	private ?Collection $serialNumber = null;

	function __construct()
	{
		parent::__construct();
		$this->serialNumber = new ArrayCollection();
	}

	public function addSerialNumber(string $serialNumber): void
	{
		$this->serialNumber[] = $serialNumber;
	}

	public function removeSerialNumber(string $serialNumber): void
	{
		$this->serialNumber->removeElement($serialNumber);
	}

	/**
	 * @return Collection<Text>|null
	 */
	public function getSerialNumber(): Collection
	{
		return $this->serialNumber;
	}
}
