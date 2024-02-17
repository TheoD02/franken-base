<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A FundingAgency is an organization that implements one or more \[\[FundingScheme\]\]s and manages the granting process (via \[\[Grant\]\]s, typically \[\[MonetaryGrant\]\]s). A funding agency is not always required for grant funding, e.g. philanthropic giving, corporate sponsorship etc. Examples of funding agencies include ERC, REA, NIH, Bill and Melinda Gates Foundation, ...
 *
 * @see https://schema.org/FundingAgency
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/FundingAgency'])]
class FundingAgency extends Project
{
}
