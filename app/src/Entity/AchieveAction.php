<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * The act of accomplishing something via previous efforts. It is an instantaneous action rather than an ongoing process.
 *
 * @see https://schema.org/AchieveAction
 */
#[ORM\MappedSuperclass]
abstract class AchieveAction extends Action
{
}
