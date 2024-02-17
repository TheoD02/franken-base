<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of un-registering from a service.\\n\\nRelated actions:\\n\\n\* \[\[RegisterAction\]\]: antonym of UnRegisterAction.\\n\* \[\[LeaveAction\]\]: Unlike LeaveAction, UnRegisterAction implies that you are unregistering from a service you were previously registered, rather than leaving a team/group of people.
 *
 * @see https://schema.org/UnRegisterAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/UnRegisterAction'])]
class UnRegisterAction extends InteractAction
{
}
