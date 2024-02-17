<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An AnalysisNewsArticle is a \[\[NewsArticle\]\] that, while based on factual reporting, incorporates the expertise of the author/producer, offering interpretations and conclusions.
 *
 * @see https://schema.org/AnalysisNewsArticle
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/AnalysisNewsArticle'])]
class AnalysisNewsArticle extends NewsArticle
{
}
