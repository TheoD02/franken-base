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
use App\Enum\PaymentMethod;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A statement of the money due for goods or services; a bill.
 *
 * @see https://schema.org/Invoice
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Invoice'])]
class Invoice extends Intangible
{
	/**
	 * The date the invoice is scheduled to be paid.
	 *
	 * @see https://schema.org/scheduledPaymentDate
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
	#[ApiProperty(types: ['https://schema.org/scheduledPaymentDate'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $scheduledPaymentDate = null;

	/**
	 * The service provider, service operator, or service performer; the goods producer. Another party (a seller) may offer those services or goods on behalf of the provider. A provider may also serve as the seller.
	 *
	 * @see https://schema.org/provider
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ApiProperty(types: ['https://schema.org/provider'])]
	private ?Person $provider = null;

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
	 * The total amount due.
	 *
	 * @see https://schema.org/totalPaymentDue
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\PriceSpecification')]
	#[ApiProperty(types: ['https://schema.org/totalPaymentDue'])]
	private ?PriceSpecification $totalPaymentDue = null;

	/**
	 * @var Collection<Text>|null A category for the item. Greater signs or slashes can be used to informally indicate a category hierarchy.
	 * @see https://schema.org/category
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinTable(name: 'invoice_text_category')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/category'])]
	private ?Collection $category = null;

	/**
	 * An identifier for the method of payment used (e.g. the last 4 digits of the credit card).
	 *
	 * @see https://schema.org/paymentMethodId
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/paymentMethodId'])]
	private ?string $paymentMethodId = null;

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
	 * The identifier for the account the payment will be applied to.
	 *
	 * @see https://schema.org/accountId
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/accountId'])]
	private ?string $accountId = null;

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
	 * The minimum payment required at this time.
	 *
	 * @see https://schema.org/minimumPaymentDue
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\PriceSpecification')]
	#[ApiProperty(types: ['https://schema.org/minimumPaymentDue'])]
	private ?PriceSpecification $minimumPaymentDue = null;

	/**
	 * The status of payment; whether the invoice has been paid or not.
	 *
	 * @see https://schema.org/paymentStatus
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/paymentStatus'])]
	private ?string $paymentStatus = null;

	/**
	 * The time interval used to compute the invoice.
	 *
	 * @see https://schema.org/billingPeriod
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Duration')]
	#[ApiProperty(types: ['https://schema.org/billingPeriod'])]
	private ?Duration $billingPeriod = null;

	/**
	 * @var Collection<Order>|null The Order(s) related to this Invoice. One or more Orders may be combined into a single Invoice.
	 * @see https://schema.org/referencesOrder
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Order')]
	#[ORM\JoinTable(name: 'invoice_order_references_order')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/referencesOrder'])]
	private ?Collection $referencesOrder = null;

	/**
	 * A number that confirms the given order or payment has been received.
	 *
	 * @see https://schema.org/confirmationNumber
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/confirmationNumber'])]
	private ?string $confirmationNumber = null;

	/**
	 * The name of the credit card or other method of payment for the order.
	 *
	 * @see https://schema.org/paymentMethod
	 */
	#[ORM\Column(nullable: true)]
	#[ApiProperty(types: ['https://schema.org/paymentMethod'])]
	#[Assert\Choice(callback: [PaymentMethod::class, 'toArray'])]
	private ?string $paymentMethod = null;

	function __construct()
	{
		$this->category = new ArrayCollection();
		$this->referencesOrder = new ArrayCollection();
	}

	public function setScheduledPaymentDate(?\DateTimeInterface $scheduledPaymentDate): void
	{
		$this->scheduledPaymentDate = $scheduledPaymentDate;
	}

	public function getScheduledPaymentDate(): ?\DateTimeInterface
	{
		return $this->scheduledPaymentDate;
	}

	public function setProvider(?Person $provider): void
	{
		$this->provider = $provider;
	}

	public function getProvider(): ?Person
	{
		return $this->provider;
	}

	public function setBroker(Person $broker): void
	{
		$this->broker = $broker;
	}

	public function getBroker(): Person
	{
		return $this->broker;
	}

	public function setTotalPaymentDue(?PriceSpecification $totalPaymentDue): void
	{
		$this->totalPaymentDue = $totalPaymentDue;
	}

	public function getTotalPaymentDue(): ?PriceSpecification
	{
		return $this->totalPaymentDue;
	}

	public function addCategory(string $category): void
	{
		$this->category[] = $category;
	}

	public function removeCategory(string $category): void
	{
		$this->category->removeElement($category);
	}

	/**
	 * @return Collection<Text>|null
	 */
	public function getCategory(): Collection
	{
		return $this->category;
	}

	public function setPaymentMethodId(?string $paymentMethodId): void
	{
		$this->paymentMethodId = $paymentMethodId;
	}

	public function getPaymentMethodId(): ?string
	{
		return $this->paymentMethodId;
	}

	public function setCustomer(Organization $customer): void
	{
		$this->customer = $customer;
	}

	public function getCustomer(): Organization
	{
		return $this->customer;
	}

	public function setAccountId(?string $accountId): void
	{
		$this->accountId = $accountId;
	}

	public function getAccountId(): ?string
	{
		return $this->accountId;
	}

	public function setPaymentDueDate(?\DateTimeInterface $paymentDueDate): void
	{
		$this->paymentDueDate = $paymentDueDate;
	}

	public function getPaymentDueDate(): ?\DateTimeInterface
	{
		return $this->paymentDueDate;
	}

	public function setMinimumPaymentDue(?PriceSpecification $minimumPaymentDue): void
	{
		$this->minimumPaymentDue = $minimumPaymentDue;
	}

	public function getMinimumPaymentDue(): ?PriceSpecification
	{
		return $this->minimumPaymentDue;
	}

	public function setPaymentStatus(?string $paymentStatus): void
	{
		$this->paymentStatus = $paymentStatus;
	}

	public function getPaymentStatus(): ?string
	{
		return $this->paymentStatus;
	}

	public function setBillingPeriod(?Duration $billingPeriod): void
	{
		$this->billingPeriod = $billingPeriod;
	}

	public function getBillingPeriod(): ?Duration
	{
		return $this->billingPeriod;
	}

	public function addReferencesOrder(Order $referencesOrder): void
	{
		$this->referencesOrder[] = $referencesOrder;
	}

	public function removeReferencesOrder(Order $referencesOrder): void
	{
		$this->referencesOrder->removeElement($referencesOrder);
	}

	/**
	 * @return Collection<Order>|null
	 */
	public function getReferencesOrder(): Collection
	{
		return $this->referencesOrder;
	}

	public function setConfirmationNumber(?string $confirmationNumber): void
	{
		$this->confirmationNumber = $confirmationNumber;
	}

	public function getConfirmationNumber(): ?string
	{
		return $this->confirmationNumber;
	}

	public function setPaymentMethod(?string $paymentMethod): void
	{
		$this->paymentMethod = $paymentMethod;
	}

	public function getPaymentMethod(): ?string
	{
		return $this->paymentMethod;
	}
}
