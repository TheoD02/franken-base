<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Professional service: Attorney. \\n\\nThis type is deprecated - \[\[LegalService\]\] is more inclusive and less ambiguous.
 *
 * @see https://schema.org/Attorney
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Attorney'])]
class Attorney extends LegalService
{
}
