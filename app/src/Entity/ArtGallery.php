<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An art gallery.
 *
 * @see https://schema.org/ArtGallery
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ArtGallery'])]
class ArtGallery extends EntertainmentBusiness
{
}
