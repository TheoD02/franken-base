<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An agent quotes/estimates/appraises an object/product/service with a price at a location/store.
 *
 * @see https://schema.org/QuoteAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/QuoteAction'])]
#[ORM\AssociationOverrides([
    new ORM\AssociationOverride(
        name: 'priceSpecification',
        joinTable: new ORM\JoinTable(name: 'join_table_392b19be'),
        joinColumns: [new ORM\JoinColumn()],
        inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
    ),
])]
class QuoteAction extends TradeAction
{
}
