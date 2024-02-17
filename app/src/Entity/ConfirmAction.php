<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of notifying someone that a future event/action is going to happen as expected.\\n\\nRelated actions:\\n\\n\* \[\[CancelAction\]\]: The antonym of ConfirmAction.
 *
 * @see https://schema.org/ConfirmAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ConfirmAction'])]
class ConfirmAction extends InformAction
{
}
