<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Enum\DeliveryMethod;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An agent orders an object/product/service to be delivered/sent.
 *
 * @see https://schema.org/OrderAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/OrderAction'])]
#[ORM\AssociationOverrides([
    new ORM\AssociationOverride(
        name: 'priceSpecification',
        joinTable: new ORM\JoinTable(name: 'join_table_387719ac'),
        joinColumns: [new ORM\JoinColumn()],
        inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
    ),
])]
class OrderAction extends TradeAction
{
    /**
     * A sub property of instrument. The method of delivery.
     *
     * @see https://schema.org/deliveryMethod
     */
    #[ORM\Column]
    #[ApiProperty(types: ['https://schema.org/deliveryMethod'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [DeliveryMethod::class, 'toArray'])]
    private string $deliveryMethod;

    public function setDeliveryMethod(string $deliveryMethod): void
    {
        $this->deliveryMethod = $deliveryMethod;
    }

    public function getDeliveryMethod(): string
    {
        return $this->deliveryMethod;
    }
}
