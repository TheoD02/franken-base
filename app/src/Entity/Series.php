<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A Series in schema.org is a group of related items, typically but not necessarily of the same kind. See also \[\[CreativeWorkSeries\]\], \[\[EventSeries\]\].
 *
 * @see https://schema.org/Series
 */
#[ORM\MappedSuperclass]
abstract class Series extends Intangible
{
}
