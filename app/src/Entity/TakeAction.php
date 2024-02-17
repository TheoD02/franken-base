<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of gaining ownership of an object from an origin. Reciprocal of GiveAction.\\n\\nRelated actions:\\n\\n\* \[\[GiveAction\]\]: The reciprocal of TakeAction.\\n\* \[\[ReceiveAction\]\]: Unlike ReceiveAction, TakeAction implies that ownership has been transferred.
 *
 * @see https://schema.org/TakeAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TakeAction'])]
class TakeAction extends TransferAction
{
}
