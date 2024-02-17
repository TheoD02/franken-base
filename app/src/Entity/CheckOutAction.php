<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of an agent communicating (service provider, social media, etc) their departure of a previously reserved service (e.g. flight check-in) or place (e.g. hotel).\\n\\nRelated actions:\\n\\n\* \[\[CheckInAction\]\]: The antonym of CheckOutAction.\\n\* \[\[DepartAction\]\]: Unlike DepartAction, CheckOutAction implies that the agent is informing/confirming the end of a previously reserved service.\\n\* \[\[CancelAction\]\]: Unlike CancelAction, CheckOutAction implies that the agent is informing/confirming the end of a previously reserved service.
 *
 * @see https://schema.org/CheckOutAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/CheckOutAction'])]
class CheckOutAction extends CommunicateAction
{
}
