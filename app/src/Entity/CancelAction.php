<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of asserting that a future event/action is no longer going to happen.\\n\\nRelated actions:\\n\\n\* \[\[ConfirmAction\]\]: The antonym of CancelAction.
 *
 * @see https://schema.org/CancelAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/CancelAction'])]
class CancelAction extends PlanAction
{
}
