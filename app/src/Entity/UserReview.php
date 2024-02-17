<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A review created by an end-user (e.g. consumer, purchaser, attendee etc.), in contrast with \[\[CriticReview\]\].
 *
 * @see https://schema.org/UserReview
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/UserReview'])]
class UserReview extends Review
{
}
