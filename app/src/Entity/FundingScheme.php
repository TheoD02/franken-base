<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A FundingScheme combines organizational, project and policy aspects of grant-based funding that sets guidelines, principles and mechanisms to support other kinds of projects and activities. Funding is typically organized via \[\[Grant\]\] funding. Examples of funding schemes: Swiss Priority Programmes (SPPs); EU Framework 7 (FP7); Horizon 2020; the NIH-R01 Grant Program; Wellcome institutional strategic support fund. For large scale public sector funding, the management and administration of grant awards is often handled by other, dedicated, organizations - \[\[FundingAgency\]\]s such as ERC, REA, ...
 *
 * @see https://schema.org/FundingScheme
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/FundingScheme'])]
class FundingScheme extends Organization
{
}
