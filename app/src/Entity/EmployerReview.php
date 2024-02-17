<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An \[\[EmployerReview\]\] is a review of an \[\[Organization\]\] regarding its role as an employer, written by a current or former employee of that organization.
 *
 * @see https://schema.org/EmployerReview
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/EmployerReview'])]
class EmployerReview extends Review
{
}
