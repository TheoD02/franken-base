<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An \[\[Article\]\] that an external entity has paid to place or to produce to its specifications. Includes \[advertorials\](https://en.wikipedia.org/wiki/Advertorial), sponsored content, native advertising and other paid content.
 *
 * @see https://schema.org/AdvertiserContentArticle
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/AdvertiserContentArticle'])]
class AdvertiserContentArticle extends Article
{
}
