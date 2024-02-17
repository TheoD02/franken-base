<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of committing to/adopting an object.\\n\\nRelated actions:\\n\\n\* \[\[RejectAction\]\]: The antonym of AcceptAction.
 *
 * @see https://schema.org/AcceptAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/AcceptAction'])]
class AcceptAction extends AllocateAction
{
}
