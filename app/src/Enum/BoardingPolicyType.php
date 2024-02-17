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
 * A type of boarding policy used by an airline.
 *
 * @see https://schema.org/BoardingPolicyType
 */
class BoardingPolicyType extends Enum
{
	/** @var string The airline boards by groups based on check-in time, priority, etc. */
	public const GROUP_BOARDING_POLICY = 'https://schema.org/GroupBoardingPolicy';

	/** @var string The airline boards by zones of the plane. */
	public const ZONE_BOARDING_POLICY = 'https://schema.org/ZoneBoardingPolicy';
}
