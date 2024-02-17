<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of allocating an action/event/task to some destination (someone or something).
 *
 * @see https://schema.org/AssignAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/AssignAction'])]
class AssignAction extends AllocateAction
{
}
