<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A tool used (but not consumed) when performing instructions for how to achieve a result.
 *
 * @see https://schema.org/HowToTool
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/HowToTool'])]
#[ORM\AssociationOverrides([
    new ORM\AssociationOverride(
        name: 'requiredQuantity',
        joinTable: new ORM\JoinTable(name: 'how_to_item_quantitative_value_required_quantity_how_to_tool'),
        joinColumns: [new ORM\JoinColumn()],
        inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
    ),
])]
class HowToTool extends HowToItem
{
}
