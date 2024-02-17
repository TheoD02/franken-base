<?php

namespace App\Enum;

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
use MyCLabs\Enum\Enum;

/**
 * Enumerated status values for Order.
 *
 * @see https://schema.org/OrderStatus
 */
class OrderStatus extends Enum
{
	/** @var string OrderStatus representing cancellation of an order. */
	public const ORDER_CANCELLED = 'https://schema.org/OrderCancelled';

	/** @var string OrderStatus representing that an order is being processed. */
	public const ORDER_PROCESSING = 'https://schema.org/OrderProcessing';

	/** @var string OrderStatus representing availability of an order for pickup. */
	public const ORDER_PICKUP_AVAILABLE = 'https://schema.org/OrderPickupAvailable';

	/** @var string OrderStatus representing that an order is in transit. */
	public const ORDER_IN_TRANSIT = 'https://schema.org/OrderInTransit';

	/** @var string OrderStatus representing that there is a problem with the order. */
	public const ORDER_PROBLEM = 'https://schema.org/OrderProblem';

	/** @var string OrderStatus representing that payment is due on an order. */
	public const ORDER_PAYMENT_DUE = 'https://schema.org/OrderPaymentDue';

	/** @var string OrderStatus representing successful delivery of an order. */
	public const ORDER_DELIVERED = 'https://schema.org/OrderDelivered';

	/** @var string OrderStatus representing that an order has been returned. */
	public const ORDER_RETURNED = 'https://schema.org/OrderReturned';
}
