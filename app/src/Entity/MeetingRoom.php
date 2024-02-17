<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A meeting room, conference room, or conference hall is a room provided for singular events such as business conferences and meetings (source: Wikipedia, the free encyclopedia, see [http://en.wikipedia.org/wiki/Conference\_hall](http://en.wikipedia.org/wiki/Conference_hall)).
 *
 * See also the [dedicated document on the use of schema.org for marking up hotels and other forms of accommodations](/docs/hotels.html).
 *
 * @see https://schema.org/MeetingRoom
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MeetingRoom'])]
class MeetingRoom extends Room
{
}
