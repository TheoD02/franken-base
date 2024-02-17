<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Enum\DeliveryMethod;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The delivery of a parcel either via the postal service or a commercial service.
 *
 * @see https://schema.org/ParcelDelivery
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ParcelDelivery'])]
class ParcelDelivery extends Intangible
{
    /**
     * Tracking url for the parcel delivery.
     *
     * @see https://schema.org/trackingUrl
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
    #[ApiProperty(types: ['https://schema.org/trackingUrl'])]
    #[Assert\Url]
    private ?string $trackingUrl = null;

    /**
     * The service provider, service operator, or service performer; the goods producer. Another party (a seller) may offer those services or goods on behalf of the provider. A provider may also serve as the seller.
     *
     * @see https://schema.org/provider
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ApiProperty(types: ['https://schema.org/provider'])]
    private ?Person $provider = null;

    /**
     * New entry added as the package passes through each leg of its journey (from shipment to final delivery).
     *
     * @see https://schema.org/deliveryStatus
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\DeliveryEvent')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/deliveryStatus'])]
    #[Assert\NotNull]
    private DeliveryEvent $deliveryStatus;

    /**
     * The overall order the items in this delivery were included in.
     *
     * @see https://schema.org/partOfOrder
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Order')]
    #[ApiProperty(types: ['https://schema.org/partOfOrder'])]
    private ?Order $partOfOrder = null;

    /**
     * The latest date the package may arrive.
     *
     * @see https://schema.org/expectedArrivalUntil
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/expectedArrivalUntil'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $expectedArrivalUntil = null;

    /**
     * @var Collection<Product>|null item(s) being shipped
     *
     * @see https://schema.org/itemShipped
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Product')]
    #[ORM\JoinTable(name: 'parcel_delivery_product_item_shipped')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/itemShipped'])]
    private ?Collection $itemShipped = null;

    /**
     * The earliest date the package may arrive.
     *
     * @see https://schema.org/expectedArrivalFrom
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/expectedArrivalFrom'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $expectedArrivalFrom = null;

    /**
     * Shipper's address.
     *
     * @see https://schema.org/originAddress
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\PostalAddress')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/originAddress'])]
    #[Assert\NotNull]
    private PostalAddress $originAddress;

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

    /**
     * Destination address.
     *
     * @see https://schema.org/deliveryAddress
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\PostalAddress')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/deliveryAddress'])]
    #[Assert\NotNull]
    private PostalAddress $deliveryAddress;

    /**
     * Shipper tracking number.
     *
     * @see https://schema.org/trackingNumber
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/trackingNumber'])]
    private ?string $trackingNumber = null;

    public function __construct()
    {
        $this->itemShipped = new ArrayCollection();
    }

    public function setTrackingUrl(?string $trackingUrl): void
    {
        $this->trackingUrl = $trackingUrl;
    }

    public function getTrackingUrl(): ?string
    {
        return $this->trackingUrl;
    }

    public function setProvider(?Person $provider): void
    {
        $this->provider = $provider;
    }

    public function getProvider(): ?Person
    {
        return $this->provider;
    }

    public function setDeliveryStatus(DeliveryEvent $deliveryStatus): void
    {
        $this->deliveryStatus = $deliveryStatus;
    }

    public function getDeliveryStatus(): DeliveryEvent
    {
        return $this->deliveryStatus;
    }

    public function setPartOfOrder(?Order $partOfOrder): void
    {
        $this->partOfOrder = $partOfOrder;
    }

    public function getPartOfOrder(): ?Order
    {
        return $this->partOfOrder;
    }

    public function setExpectedArrivalUntil(?\DateTimeInterface $expectedArrivalUntil): void
    {
        $this->expectedArrivalUntil = $expectedArrivalUntil;
    }

    public function getExpectedArrivalUntil(): ?\DateTimeInterface
    {
        return $this->expectedArrivalUntil;
    }

    public function addItemShipped(Product $itemShipped): void
    {
        $this->itemShipped[] = $itemShipped;
    }

    public function removeItemShipped(Product $itemShipped): void
    {
        $this->itemShipped->removeElement($itemShipped);
    }

    /**
     * @return Collection<Product>|null
     */
    public function getItemShipped(): Collection
    {
        return $this->itemShipped;
    }

    public function setExpectedArrivalFrom(?\DateTimeInterface $expectedArrivalFrom): void
    {
        $this->expectedArrivalFrom = $expectedArrivalFrom;
    }

    public function getExpectedArrivalFrom(): ?\DateTimeInterface
    {
        return $this->expectedArrivalFrom;
    }

    public function setOriginAddress(PostalAddress $originAddress): void
    {
        $this->originAddress = $originAddress;
    }

    public function getOriginAddress(): PostalAddress
    {
        return $this->originAddress;
    }

    public function setHasDeliveryMethod(string $hasDeliveryMethod): void
    {
        $this->hasDeliveryMethod = $hasDeliveryMethod;
    }

    public function getHasDeliveryMethod(): string
    {
        return $this->hasDeliveryMethod;
    }

    public function setDeliveryAddress(PostalAddress $deliveryAddress): void
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    public function getDeliveryAddress(): PostalAddress
    {
        return $this->deliveryAddress;
    }

    public function setTrackingNumber(?string $trackingNumber): void
    {
        $this->trackingNumber = $trackingNumber;
    }

    public function getTrackingNumber(): ?string
    {
        return $this->trackingNumber;
    }
}
