<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Web page type: Checkout page.
 *
 * @see https://schema.org/CheckoutPage
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/CheckoutPage'])]
#[ORM\AssociationOverrides([
    new ORM\AssociationOverride(
        name: 'speakable',
        joinTable: new ORM\JoinTable(name: 'web_page_url_speakable_checkout_page'),
        joinColumns: [new ORM\JoinColumn()],
        inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
    ),
])]
class CheckoutPage extends WebPage
{
}
