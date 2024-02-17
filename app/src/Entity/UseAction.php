<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * The act of applying an object to its intended purpose.
 *
 * @see https://schema.org/UseAction
 */
#[ORM\MappedSuperclass]
abstract class UseAction extends ConsumeAction
{
}
