<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Web page type: Image gallery page.
 *
 * @see https://schema.org/ImageGallery
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ImageGallery'])]
#[ORM\AssociationOverrides([
    new ORM\AssociationOverride(
        name: 'speakable',
        joinTable: new ORM\JoinTable(name: 'web_page_url_speakable_image_gallery'),
        joinColumns: [new ORM\JoinColumn()],
        inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
    ),
])]
class ImageGallery extends MediaGallery
{
}
