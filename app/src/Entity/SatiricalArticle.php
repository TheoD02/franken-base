<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An \[\[Article\]\] whose content is primarily \[\[satirical\]\](https://en.wikipedia.org/wiki/Satire) in nature, i.e. unlikely to be literally true. A satirical article is sometimes but not necessarily also a \[\[NewsArticle\]\]. \[\[ScholarlyArticle\]\]s are also sometimes satirized.
 *
 * @see https://schema.org/SatiricalArticle
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SatiricalArticle'])]
class SatiricalArticle extends Article
{
}
