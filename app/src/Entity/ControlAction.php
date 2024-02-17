<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * An agent controls a device or application.
 *
 * @see https://schema.org/ControlAction
 */
#[ORM\MappedSuperclass]
abstract class ControlAction extends Action
{
}
