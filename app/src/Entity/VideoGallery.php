<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Web page type: Video gallery page.
 *
 * @see https://schema.org/VideoGallery
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/VideoGallery'])]
#[ORM\AssociationOverrides([
    new ORM\AssociationOverride(
        name: 'speakable',
        joinTable: new ORM\JoinTable(name: 'web_page_url_speakable_video_gallery'),
        joinColumns: [new ORM\JoinColumn()],
        inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
    ),
])]
class VideoGallery extends MediaGallery
{
}
