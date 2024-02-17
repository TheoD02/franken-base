<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Web page type: Search results page.
 *
 * @see https://schema.org/SearchResultsPage
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SearchResultsPage'])]
#[ORM\AssociationOverrides([
    new ORM\AssociationOverride(
        name: 'speakable',
        joinTable: new ORM\JoinTable(name: 'web_page_url_speakable_search_results_page'),
        joinColumns: [new ORM\JoinColumn()],
        inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
    ),
])]
class SearchResultsPage extends WebPage
{
}
