<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Scheduling future actions, events, or tasks.\\n\\nRelated actions:\\n\\n\* \[\[ReserveAction\]\]: Unlike ReserveAction, ScheduleAction allocates future actions (e.g. an event, a task, etc) towards a time slot / spatial allocation.
 *
 * @see https://schema.org/ScheduleAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ScheduleAction'])]
class ScheduleAction extends PlanAction
{
}
