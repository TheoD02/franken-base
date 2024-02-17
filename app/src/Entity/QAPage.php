<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A QAPage is a WebPage focussed on a specific Question and its Answer(s), e.g. in a question answering site or documenting Frequently Asked Questions (FAQs).
 *
 * @see https://schema.org/QAPage
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/QAPage'])]
#[ORM\AssociationOverrides([
    new ORM\AssociationOverride(
        name: 'speakable',
        joinTable: new ORM\JoinTable(name: 'web_page_url_speakable_qa_page'),
        joinColumns: [new ORM\JoinColumn()],
        inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
    ),
])]
class QAPage extends WebPage
{
}
