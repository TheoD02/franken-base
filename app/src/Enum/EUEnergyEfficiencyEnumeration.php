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
 * Enumerates the EU energy efficiency classes A-G as well as A+, A++, and A+++ as defined in EU directive 2017/1369.
 *
 * @see https://schema.org/EUEnergyEfficiencyEnumeration
 */
class EUEnergyEfficiencyEnumeration extends Enum
{
	/** @var string Represents EU Energy Efficiency Class A as defined in EU energy labeling regulations. */
	public const E_U_ENERGY_EFFICIENCY_CATEGORY_A = 'https://schema.org/EUEnergyEfficiencyCategoryA';

	/** @var string Represents EU Energy Efficiency Class E as defined in EU energy labeling regulations. */
	public const E_U_ENERGY_EFFICIENCY_CATEGORY_E = 'https://schema.org/EUEnergyEfficiencyCategoryE';

	/** @var string Represents EU Energy Efficiency Class D as defined in EU energy labeling regulations. */
	public const E_U_ENERGY_EFFICIENCY_CATEGORY_D = 'https://schema.org/EUEnergyEfficiencyCategoryD';

	/** @var string Represents EU Energy Efficiency Class G as defined in EU energy labeling regulations. */
	public const E_U_ENERGY_EFFICIENCY_CATEGORY_G = 'https://schema.org/EUEnergyEfficiencyCategoryG';

	/** @var string Represents EU Energy Efficiency Class F as defined in EU energy labeling regulations. */
	public const E_U_ENERGY_EFFICIENCY_CATEGORY_F = 'https://schema.org/EUEnergyEfficiencyCategoryF';

	/** @var string Represents EU Energy Efficiency Class B as defined in EU energy labeling regulations. */
	public const E_U_ENERGY_EFFICIENCY_CATEGORY_B = 'https://schema.org/EUEnergyEfficiencyCategoryB';

	/** @var string Represents EU Energy Efficiency Class A+++ as defined in EU energy labeling regulations. */
	public const E_U_ENERGY_EFFICIENCY_CATEGORY_A3_PLUS = 'https://schema.org/EUEnergyEfficiencyCategoryA3Plus';

	/** @var string Represents EU Energy Efficiency Class C as defined in EU energy labeling regulations. */
	public const E_U_ENERGY_EFFICIENCY_CATEGORY_C = 'https://schema.org/EUEnergyEfficiencyCategoryC';

	/** @var string Represents EU Energy Efficiency Class A++ as defined in EU energy labeling regulations. */
	public const E_U_ENERGY_EFFICIENCY_CATEGORY_A2_PLUS = 'https://schema.org/EUEnergyEfficiencyCategoryA2Plus';

	/** @var string Represents EU Energy Efficiency Class A+ as defined in EU energy labeling regulations. */
	public const E_U_ENERGY_EFFICIENCY_CATEGORY_A1_PLUS = 'https://schema.org/EUEnergyEfficiencyCategoryA1Plus';
}
