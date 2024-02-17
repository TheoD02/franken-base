<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of registering to an organization/service without the guarantee to receive it.\\n\\nRelated actions:\\n\\n\* \[\[RegisterAction\]\]: Unlike RegisterAction, ApplyAction has no guarantees that the application will be accepted.
 *
 * @see https://schema.org/ApplyAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ApplyAction'])]
class ApplyAction extends OrganizeAction
{
}
