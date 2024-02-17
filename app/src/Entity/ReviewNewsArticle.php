<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A \[\[NewsArticle\]\] and \[\[CriticReview\]\] providing a professional critic's assessment of a service, product, performance, or artistic or literary work.
 *
 * @see https://schema.org/ReviewNewsArticle
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ReviewNewsArticle'])]
class ReviewNewsArticle extends NewsArticle
{
}
