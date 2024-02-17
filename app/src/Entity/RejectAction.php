<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of rejecting to/adopting an object.\\n\\nRelated actions:\\n\\n\* \[\[AcceptAction\]\]: The antonym of RejectAction.
 *
 * @see https://schema.org/RejectAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/RejectAction'])]
class RejectAction extends AllocateAction
{
}
