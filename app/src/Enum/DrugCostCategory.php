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
 * Enumerated categories of medical drug costs.
 *
 * @see https://schema.org/DrugCostCategory
 */
class DrugCostCategory extends Enum
{
	/** @var string The drug's cost represents the retail cost of the drug. */
	public const RETAIL = 'https://schema.org/Retail';

	/** @var string The drug's cost represents the wholesale acquisition cost of the drug. */
	public const WHOLESALE = 'https://schema.org/Wholesale';

	/** @var string The drug's cost represents the maximum reimbursement paid by an insurer for the drug. */
	public const REIMBURSEMENT_CAP = 'https://schema.org/ReimbursementCap';
}
