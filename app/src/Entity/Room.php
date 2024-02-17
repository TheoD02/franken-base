<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A room is a distinguishable space within a structure, usually separated from other spaces by interior walls (source: Wikipedia, the free encyclopedia, see <http://en.wikipedia.org/wiki/Room>).
 *
 * See also the [dedicated document on the use of schema.org for marking up hotels and other forms of accommodations](/docs/hotels.html).
 *
 * @see https://schema.org/Room
 */
#[ORM\MappedSuperclass]
abstract class Room extends Accommodation
{
}
