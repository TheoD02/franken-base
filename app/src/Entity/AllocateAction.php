<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * The act of organizing tasks/objects/events by associating resources to it.
 *
 * @see https://schema.org/AllocateAction
 */
#[ORM\MappedSuperclass]
abstract class AllocateAction extends OrganizeAction
{
}
