<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A supply consumed when performing the instructions for how to achieve a result.
 *
 * @see https://schema.org/HowToSupply
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/HowToSupply'])]
#[ORM\AssociationOverrides([
    new ORM\AssociationOverride(
        name: 'requiredQuantity',
        joinTable: new ORM\JoinTable(name: 'how_to_item_quantitative_value_required_quantity_how_to_supply'),
        joinColumns: [new ORM\JoinColumn()],
        inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
    ),
])]
class HowToSupply extends HowToItem
{
    /**
     * The estimated cost of the supply or supplies consumed when performing instructions.
     *
     * @see https://schema.org/estimatedCost
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MonetaryAmount')]
    #[ApiProperty(types: ['https://schema.org/estimatedCost'])]
    private ?MonetaryAmount $estimatedCost = null;

    public function setEstimatedCost(?MonetaryAmount $estimatedCost): void
    {
        $this->estimatedCost = $estimatedCost;
    }

    public function getEstimatedCost(): ?MonetaryAmount
    {
        return $this->estimatedCost;
    }
}
