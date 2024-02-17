<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of forming a personal connection with someone/something (object) unidirectionally/asymmetrically to get updates pushed to.\\n\\nRelated actions:\\n\\n\* \[\[FollowAction\]\]: Unlike FollowAction, SubscribeAction implies that the subscriber acts as a passive agent being constantly/actively pushed for updates.\\n\* \[\[RegisterAction\]\]: Unlike RegisterAction, SubscribeAction implies that the agent is interested in continuing receiving updates from the object.\\n\* \[\[JoinAction\]\]: Unlike JoinAction, SubscribeAction implies that the agent is interested in continuing receiving updates from the object.
 *
 * @see https://schema.org/SubscribeAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SubscribeAction'])]
class SubscribeAction extends InteractAction
{
}
