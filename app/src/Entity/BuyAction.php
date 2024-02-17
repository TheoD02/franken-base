<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The act of giving money to a seller in exchange for goods or services rendered. An agent buys an object, product, or service from a seller for a price. Reciprocal of SellAction.
 *
 * @see https://schema.org/BuyAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/BuyAction'])]
#[ORM\AssociationOverrides([
    new ORM\AssociationOverride(
        name: 'priceSpecification',
        joinTable: new ORM\JoinTable(name: 'trade_action_price_specification_price_specification_buy_action'),
        joinColumns: [new ORM\JoinColumn()],
        inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
    ),
])]
class BuyAction extends TradeAction
{
    /**
     * An entity which offers (sells / leases / lends / loans) the services / goods. A seller may also be a provider.
     *
     * @see https://schema.org/seller
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/seller'])]
    #[Assert\NotNull]
    private Person $seller;

    public function setSeller(Person $seller): void
    {
        $this->seller = $seller;
    }

    public function getSeller(): Person
    {
        return $this->seller;
    }
}
