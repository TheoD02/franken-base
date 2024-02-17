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
 * NLNonprofitType: Non-profit organization type originating from the Netherlands.
 *
 * @see https://schema.org/NLNonprofitType
 */
class NLNonprofitType extends Enum
{
	/** @var string NonprofitANBI: Non-profit type referring to a Public Benefit Organization (NL). */
	public const NONPROFIT_A_N_B_I = 'https://schema.org/NonprofitANBI';

	/** @var string NonprofitSBBI: Non-profit type referring to a Social Interest Promoting Institution (NL). */
	public const NONPROFIT_S_B_B_I = 'https://schema.org/NonprofitSBBI';
}
