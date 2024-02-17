<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of registering to be a user of a service, product or web page.\\n\\nRelated actions:\\n\\n\* \[\[JoinAction\]\]: Unlike JoinAction, RegisterAction implies you are registering to be a user of a service, \*not\* a group/team of people.\\n\* \[\[FollowAction\]\]: Unlike FollowAction, RegisterAction doesn't imply that the agent is expecting to poll for updates from the object.\\n\* \[\[SubscribeAction\]\]: Unlike SubscribeAction, RegisterAction doesn't imply that the agent is expecting updates from the object.
 *
 * @see https://schema.org/RegisterAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/RegisterAction'])]
class RegisterAction extends InteractAction
{
}
