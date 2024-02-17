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
 * A list of possible conditions for the item.
 *
 * @see https://schema.org/OfferItemCondition
 */
class OfferItemCondition extends Enum
{
	/** @var string Indicates that the item is new. */
	public const NEW_CONDITION = 'https://schema.org/NewCondition';

	/** @var string Indicates that the item is refurbished. */
	public const REFURBISHED_CONDITION = 'https://schema.org/RefurbishedCondition';

	/** @var string Indicates that the item is used. */
	public const USED_CONDITION = 'https://schema.org/UsedCondition';

	/** @var string Indicates that the item is damaged. */
	public const DAMAGED_CONDITION = 'https://schema.org/DamagedCondition';
}
