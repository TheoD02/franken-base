<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An \[\[OfferForPurchase\]\] in Schema.org represents an \[\[Offer\]\] to sell something, i.e. an \[\[Offer\]\] whose \[\[businessFunction\]\] is \[sell\](http://purl.org/goodrelations/v1#Sell.). See \[Good Relations\](https://en.wikipedia.org/wiki/GoodRelations) for background on the underlying concepts.
 *
 * @see https://schema.org/OfferForPurchase
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/OfferForPurchase'])]
class OfferForPurchase extends Offer
{
}
