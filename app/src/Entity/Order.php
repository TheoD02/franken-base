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
use App\Enum\PaymentMethod;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An order is a confirmation of a transaction (a receipt), which can contain multiple line items, each represented by an Offer that has been accepted by the customer.
 *
 * @see https://schema.org/Order
 */
#[ORM\Entity]
#[ORM\Table(name: '`order`')]
#[ApiResource(types: ['https://schema.org/Order'])]
class Order extends Intangible
{
	/**
	 * The delivery of the parcel related to this order or order item.
	 *
	 * @see https://schema.org/orderDelivery
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\ParcelDelivery')]
	#[ApiProperty(types: ['https://schema.org/orderDelivery'])]
	private ?ParcelDelivery $orderDelivery = null;

	/**
	 * An entity which offers (sells / leases / lends / loans) the services / goods. A seller may also be a provider.
	 *
	 * @see https://schema.org/seller
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/seller'])]
	#[Assert\NotNull]
	private Person $seller;

	/**
	 * An entity that arranges for an exchange between a buyer and a seller. In most cases a broker never acquires or releases ownership of a product or service involved in an exchange. If it is not clear whether an entity is a broker, seller, or buyer, the latter two terms are preferred.
	 *
	 * @see https://schema.org/broker
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/broker'])]
	#[Assert\NotNull]
	private Person $broker;

	/**
	 * The identifier of the transaction.
	 *
	 * @see https://schema.org/orderNumber
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/orderNumber'])]
	private ?string $orderNumber = null;

	/**
	 * An identifier for the method of payment used (e.g. the last 4 digits of the credit card).
	 *
	 * @see https://schema.org/paymentMethodId
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/paymentMethodId'])]
	private ?string $paymentMethodId = null;

	/**
	 * Code used to redeem a discount.
	 *
	 * @see https://schema.org/discountCode
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/discountCode'])]
	private ?string $discountCode = null;

	/**
	 * Party placing the order or paying the invoice.
	 *
	 * @see https://schema.org/customer
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/customer'])]
	#[Assert\NotNull]
	private Organization $customer;

	/**
	 * Date order was placed.
	 *
	 * @see https://schema.org/orderDate
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Date')]
	#[ApiProperty(types: ['https://schema.org/orderDate'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $orderDate = null;

	/**
	 * @var Collection<Offer>|null The offer(s) -- e.g., product, quantity and price combinations -- included in the order.
	 * @see https://schema.org/acceptedOffer
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Offer')]
	#[ORM\JoinTable(name: 'order_offer_accepted_offer')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/acceptedOffer'])]
	private ?Collection $acceptedOffer = null;

	/**
	 * The date that payment is due.
	 *
	 * @see https://schema.org/paymentDueDate
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
	#[ApiProperty(types: ['https://schema.org/paymentDueDate'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $paymentDueDate = null;

	/**
	 * The billing address for the order.
	 *
	 * @see https://schema.org/billingAddress
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\PostalAddress')]
	#[ApiProperty(types: ['https://schema.org/billingAddress'])]
	private ?PostalAddress $billingAddress = null;

	/**
	 * A number that confirms the given order or payment has been received.
	 *
	 * @see https://schema.org/confirmationNumber
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/confirmationNumber'])]
	private ?string $confirmationNumber = null;

	/**
	 * The item ordered.
	 *
	 * @see https://schema.org/orderedItem
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Product')]
	#[ApiProperty(types: ['https://schema.org/orderedItem'])]
	private ?Product $orderedItem = null;

	/**
	 * The order is being paid as part of the referenced Invoice.
	 *
	 * @see https://schema.org/partOfInvoice
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Invoice')]
	#[ApiProperty(types: ['https://schema.org/partOfInvoice'])]
	private ?Invoice $partOfInvoice = null;

	/**
	 * Indicates whether the offer was accepted as a gift for someone other than the buyer.
	 *
	 * @see https://schema.org/isGift
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Boolean')]
	#[ApiProperty(types: ['https://schema.org/isGift'])]
	private ?bool $isGift = null;

	/**
	 * The URL for sending a payment.
	 *
	 * @see https://schema.org/paymentUrl
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/paymentUrl'])]
	#[Assert\Url]
	private ?string $paymentUrl = null;

	/**
	 * The currency of the discount.\\n\\nUse standard formats: \[ISO 4217 currency format\](http://en.wikipedia.org/wiki/ISO\_4217), e.g. "USD"; \[Ticker symbol\](https://en.wikipedia.org/wiki/List\_of\_cryptocurrencies) for cryptocurrencies, e.g. "BTC"; well known names for \[Local Exchange Trading Systems\](https://en.wikipedia.org/wiki/Local\_exchange\_trading\_system) (LETS) and other currency types, e.g. "Ithaca HOUR".
	 *
	 * @see https://schema.org/discountCurrency
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/discountCurrency'])]
	private ?string $discountCurrency = null;

	/**
	 * The current status of the order.
	 *
	 * @see https://schema.org/orderStatus
	 */
	#[ORM\Column(nullable: true)]
	#[ApiProperty(types: ['https://schema.org/orderStatus'])]
	#[Assert\Choice(callback: [OrderStatus::class, 'toArray'])]
	private ?string $orderStatus = null;

	/**
	 * The name of the credit card or other method of payment for the order.
	 *
	 * @see https://schema.org/paymentMethod
	 */
	#[ORM\Column(nullable: true)]
	#[ApiProperty(types: ['https://schema.org/paymentMethod'])]
	#[Assert\Choice(callback: [PaymentMethod::class, 'toArray'])]
	private ?string $paymentMethod = null;

	/**
	 * Any discount applied (to an Order).
	 *
	 * @see https://schema.org/discount
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/discount'])]
	private ?string $discount = null;

	function __construct()
	{
		$this->acceptedOffer = new ArrayCollection();
	}

	public function setOrderDelivery(?ParcelDelivery $orderDelivery): void
	{
		$this->orderDelivery = $orderDelivery;
	}

	public function getOrderDelivery(): ?ParcelDelivery
	{
		return $this->orderDelivery;
	}

	public function setSeller(Person $seller): void
	{
		$this->seller = $seller;
	}

	public function getSeller(): Person
	{
		return $this->seller;
	}

	public function setBroker(Person $broker): void
	{
		$this->broker = $broker;
	}

	public function getBroker(): Person
	{
		return $this->broker;
	}

	public function setOrderNumber(?string $orderNumber): void
	{
		$this->orderNumber = $orderNumber;
	}

	public function getOrderNumber(): ?string
	{
		return $this->orderNumber;
	}

	public function setPaymentMethodId(?string $paymentMethodId): void
	{
		$this->paymentMethodId = $paymentMethodId;
	}

	public function getPaymentMethodId(): ?string
	{
		return $this->paymentMethodId;
	}

	public function setDiscountCode(?string $discountCode): void
	{
		$this->discountCode = $discountCode;
	}

	public function getDiscountCode(): ?string
	{
		return $this->discountCode;
	}

	public function setCustomer(Organization $customer): void
	{
		$this->customer = $customer;
	}

	public function getCustomer(): Organization
	{
		return $this->customer;
	}

	public function setOrderDate(?\DateTimeInterface $orderDate): void
	{
		$this->orderDate = $orderDate;
	}

	public function getOrderDate(): ?\DateTimeInterface
	{
		return $this->orderDate;
	}

	public function addAcceptedOffer(Offer $acceptedOffer): void
	{
		$this->acceptedOffer[] = $acceptedOffer;
	}

	public function removeAcceptedOffer(Offer $acceptedOffer): void
	{
		$this->acceptedOffer->removeElement($acceptedOffer);
	}

	/**
	 * @return Collection<Offer>|null
	 */
	public function getAcceptedOffer(): Collection
	{
		return $this->acceptedOffer;
	}

	public function setPaymentDueDate(?\DateTimeInterface $paymentDueDate): void
	{
		$this->paymentDueDate = $paymentDueDate;
	}

	public function getPaymentDueDate(): ?\DateTimeInterface
	{
		return $this->paymentDueDate;
	}

	public function setBillingAddress(?PostalAddress $billingAddress): void
	{
		$this->billingAddress = $billingAddress;
	}

	public function getBillingAddress(): ?PostalAddress
	{
		return $this->billingAddress;
	}

	public function setConfirmationNumber(?string $confirmationNumber): void
	{
		$this->confirmationNumber = $confirmationNumber;
	}

	public function getConfirmationNumber(): ?string
	{
		return $this->confirmationNumber;
	}

	public function setOrderedItem(?Product $orderedItem): void
	{
		$this->orderedItem = $orderedItem;
	}

	public function getOrderedItem(): ?Product
	{
		return $this->orderedItem;
	}

	public function setPartOfInvoice(?Invoice $partOfInvoice): void
	{
		$this->partOfInvoice = $partOfInvoice;
	}

	public function getPartOfInvoice(): ?Invoice
	{
		return $this->partOfInvoice;
	}

	public function setIsGift(?bool $isGift): void
	{
		$this->isGift = $isGift;
	}

	public function getIsGift(): ?bool
	{
		return $this->isGift;
	}

	public function setPaymentUrl(?string $paymentUrl): void
	{
		$this->paymentUrl = $paymentUrl;
	}

	public function getPaymentUrl(): ?string
	{
		return $this->paymentUrl;
	}

	public function setDiscountCurrency(?string $discountCurrency): void
	{
		$this->discountCurrency = $discountCurrency;
	}

	public function getDiscountCurrency(): ?string
	{
		return $this->discountCurrency;
	}

	public function setOrderStatus(?string $orderStatus): void
	{
		$this->orderStatus = $orderStatus;
	}

	public function getOrderStatus(): ?string
	{
		return $this->orderStatus;
	}

	public function setPaymentMethod(?string $paymentMethod): void
	{
		$this->paymentMethod = $paymentMethod;
	}

	public function getPaymentMethod(): ?string
	{
		return $this->paymentMethod;
	}

	public function setDiscount(?string $discount): void
	{
		$this->discount = $discount;
	}

	public function getDiscount(): ?string
	{
		return $this->discount;
	}
}
