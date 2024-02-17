<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An agent orders a (not yet released) object/product/service to be delivered/sent.
 *
 * @see https://schema.org/PreOrderAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PreOrderAction'])]
#[ORM\AssociationOverrides([
    new ORM\AssociationOverride(
        name: 'priceSpecification',
        joinTable: new ORM\JoinTable(name: 'join_table_87531ad3'),
        joinColumns: [new ORM\JoinColumn()],
        inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
    ),
])]
class PreOrderAction extends TradeAction
{
}
