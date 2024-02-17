<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An \[\[OfferForLease\]\] in Schema.org represents an \[\[Offer\]\] to lease out something, i.e. an \[\[Offer\]\] whose \[\[businessFunction\]\] is \[lease out\](http://purl.org/goodrelations/v1#LeaseOut.). See \[Good Relations\](https://en.wikipedia.org/wiki/GoodRelations) for background on the underlying concepts.
 *
 * @see https://schema.org/OfferForLease
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/OfferForLease'])]
class OfferForLease extends Offer
{
}
