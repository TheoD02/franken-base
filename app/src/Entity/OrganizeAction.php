<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * The act of manipulating/administering/supervising/controlling one or more objects.
 *
 * @see https://schema.org/OrganizeAction
 */
#[ORM\MappedSuperclass]
abstract class OrganizeAction extends Action
{
}
