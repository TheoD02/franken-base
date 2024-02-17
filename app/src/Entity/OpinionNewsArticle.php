<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An \[\[OpinionNewsArticle\]\] is a \[\[NewsArticle\]\] that primarily expresses opinions rather than journalistic reporting of news and events. For example, a \[\[NewsArticle\]\] consisting of a column or \[\[Blog\]\]/\[\[BlogPosting\]\] entry in the Opinions section of a news publication.
 *
 * @see https://schema.org/OpinionNewsArticle
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/OpinionNewsArticle'])]
class OpinionNewsArticle extends NewsArticle
{
}
