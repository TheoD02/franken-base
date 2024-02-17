<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A \[\[NewsArticle\]\] expressing an open call by a \[\[NewsMediaOrganization\]\] asking the public for input, insights, clarifications, anecdotes, documentation, etc., on an issue, for reporting purposes.
 *
 * @see https://schema.org/AskPublicNewsArticle
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/AskPublicNewsArticle'])]
class AskPublicNewsArticle extends NewsArticle
{
}
