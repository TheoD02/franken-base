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
use App\Enum\PaymentMethod;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The costs of settling the payment using a particular payment method.
 *
 * @see https://schema.org/PaymentChargeSpecification
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PaymentChargeSpecification'])]
class PaymentChargeSpecification extends PriceSpecification
{
	/**
	 * @var string[] The payment method(s) to which the payment charge specification applies.
	 * @see https://schema.org/appliesToPaymentMethod
	 */
	#[ORM\Column(type: 'simple_array')]
	#[ApiProperty(types: ['https://schema.org/appliesToPaymentMethod'])]
	#[Assert\NotNull]
	#[Assert\Choice(callback: [PaymentMethod::class, 'toArray'], multiple: true)]
	private Collection $appliesToPaymentMethod;

	/**
	 * @var string[]|null The delivery method(s) to which the delivery charge or payment charge specification applies.
	 * @see https://schema.org/appliesToDeliveryMethod
	 */
	#[ORM\Column(type: 'simple_array', nullable: true)]
	#[ApiProperty(types: ['https://schema.org/appliesToDeliveryMethod'])]
	#[Assert\Choice(callback: [DeliveryMethod::class, 'toArray'], multiple: true)]
	private ?Collection $appliesToDeliveryMethod = null;

	public function addAppliesToPaymentMethod($appliesToPaymentMethod): void
	{
		$this->appliesToPaymentMethod[] = (string) $appliesToPaymentMethod;
	}

	public function removeAppliesToPaymentMethod(string $appliesToPaymentMethod): void
	{
		if (false !== $key = array_search((string)$appliesToPaymentMethod, $this->appliesToPaymentMethod, true)) {
		    unset($this->appliesToPaymentMethod[$key]);
		}
	}

	/**
	 * @return string[]
	 */
	public function getAppliesToPaymentMethod(): Collection
	{
		return $this->appliesToPaymentMethod;
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
