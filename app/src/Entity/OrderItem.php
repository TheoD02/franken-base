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
use App\Enum\OrderStatus;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An order item is a line of an order. It includes the quantity and shipping details of a bought offer.
 *
 * @see https://schema.org/OrderItem
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/OrderItem'])]
class OrderItem extends Intangible
{
	/**
	 * The current status of the order item.
	 *
	 * @see https://schema.org/orderItemStatus
	 */
	#[ORM\Column(nullable: true)]
	#[ApiProperty(types: ['https://schema.org/orderItemStatus'])]
	#[Assert\Choice(callback: [OrderStatus::class, 'toArray'])]
	private ?string $orderItemStatus = null;

	/**
	 * The delivery of the parcel related to this order or order item.
	 *
	 * @see https://schema.org/orderDelivery
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\ParcelDelivery')]
	#[ApiProperty(types: ['https://schema.org/orderDelivery'])]
	private ?ParcelDelivery $orderDelivery = null;

	/**
	 * The identifier of the order item.
	 *
	 * @see https://schema.org/orderItemNumber
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/orderItemNumber'])]
	private ?string $orderItemNumber = null;

	/**
	 * The item ordered.
	 *
	 * @see https://schema.org/orderedItem
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Product')]
	#[ApiProperty(types: ['https://schema.org/orderedItem'])]
	private ?Product $orderedItem = null;

	/**
	 * The number of the item ordered. If the property is not set, assume the quantity is one.
	 *
	 * @see https://schema.org/orderQuantity
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/orderQuantity'])]
	private ?string $orderQuantity = null;

	public function setOrderItemStatus(?string $orderItemStatus): void
	{
		$this->orderItemStatus = $orderItemStatus;
	}

	public function getOrderItemStatus(): ?string
	{
		return $this->orderItemStatus;
	}

	public function setOrderDelivery(?ParcelDelivery $orderDelivery): void
	{
		$this->orderDelivery = $orderDelivery;
	}

	public function getOrderDelivery(): ?ParcelDelivery
	{
		return $this->orderDelivery;
	}

	public function setOrderItemNumber(?string $orderItemNumber): void
	{
		$this->orderItemNumber = $orderItemNumber;
	}

	public function getOrderItemNumber(): ?string
	{
		return $this->orderItemNumber;
	}

	public function setOrderedItem(?Product $orderedItem): void
	{
		$this->orderedItem = $orderedItem;
	}

	public function getOrderedItem(): ?Product
	{
		return $this->orderedItem;
	}

	public function setOrderQuantity(?string $orderQuantity): void
	{
		$this->orderQuantity = $orderQuantity;
	}

	public function getOrderQuantity(): ?string
	{
		return $this->orderQuantity;
	}
}
