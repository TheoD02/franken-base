<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of editing by adding an object to a collection.
 *
 * @see https://schema.org/AddAction
 */
#[ORM\MappedSuperclass]
abstract class AddAction extends UpdateAction
{
}
