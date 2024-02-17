<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of forming a personal connection with someone (object) mutually/bidirectionally/symmetrically.\\n\\nRelated actions:\\n\\n\* \[\[FollowAction\]\]: Unlike FollowAction, BefriendAction implies that the connection is reciprocal.
 *
 * @see https://schema.org/BefriendAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/BefriendAction'])]
class BefriendAction extends InteractAction
{
}
