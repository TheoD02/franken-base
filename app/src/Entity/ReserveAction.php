<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reserving a concrete object.\\n\\nRelated actions:\\n\\n\* \[\[ScheduleAction\]\]: Unlike ScheduleAction, ReserveAction reserves concrete objects (e.g. a table, a hotel) towards a time slot / spatial allocation.
 *
 * @see https://schema.org/ReserveAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ReserveAction'])]
class ReserveAction extends PlanAction
{
}
