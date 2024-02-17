<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A page devoted to a single item, such as a particular product or hotel.
 *
 * @see https://schema.org/ItemPage
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ItemPage'])]
#[ORM\AssociationOverrides([
    new ORM\AssociationOverride(
        name: 'speakable',
        joinTable: new ORM\JoinTable(name: 'web_page_url_speakable_item_page'),
        joinColumns: [new ORM\JoinColumn()],
        inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
    ),
])]
class ItemPage extends WebPage
{
}
