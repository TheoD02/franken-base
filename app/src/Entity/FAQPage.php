<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A \[\[FAQPage\]\] is a \[\[WebPage\]\] presenting one or more "\[Frequently asked questions\](https://en.wikipedia.org/wiki/FAQ)" (see also \[\[QAPage\]\]).
 *
 * @see https://schema.org/FAQPage
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/FAQPage'])]
#[ORM\AssociationOverrides([
    new ORM\AssociationOverride(
        name: 'speakable',
        joinTable: new ORM\JoinTable(name: 'web_page_url_speakable_faq_page'),
        joinColumns: [new ORM\JoinColumn()],
        inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
    ),
])]
class FAQPage extends WebPage
{
}
