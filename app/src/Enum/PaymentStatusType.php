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
 * A specific payment status. For example, PaymentDue, PaymentComplete, etc.
 *
 * @see https://schema.org/PaymentStatusType
 */
class PaymentStatusType extends Enum
{
	/** @var string The payment is due and considered late. */
	public const PAYMENT_PAST_DUE = 'https://schema.org/PaymentPastDue';

	/** @var string The payment has been received and processed. */
	public const PAYMENT_COMPLETE = 'https://schema.org/PaymentComplete';

	/** @var string The payment is due, but still within an acceptable time to be received. */
	public const PAYMENT_DUE = 'https://schema.org/PaymentDue';

	/** @var string The payee received the payment, but it was declined for some reason. */
	public const PAYMENT_DECLINED = 'https://schema.org/PaymentDeclined';

	/** @var string An automatic payment system is in place and will be used. */
	public const PAYMENT_AUTOMATICALLY_APPLIED = 'https://schema.org/PaymentAutomaticallyApplied';
}
