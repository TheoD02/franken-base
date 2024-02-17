<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An agent bookmarks/flags/labels/tags/marks an object.
 *
 * @see https://schema.org/BookmarkAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/BookmarkAction'])]
class BookmarkAction extends OrganizeAction
{
}
