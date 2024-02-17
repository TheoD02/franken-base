<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A posting to a discussion forum.
 *
 * @see https://schema.org/DiscussionForumPosting
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DiscussionForumPosting'])]
class DiscussionForumPosting extends SocialMediaPosting
{
}
