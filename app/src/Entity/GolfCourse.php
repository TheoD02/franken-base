<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A golf course.
 *
 * @see https://schema.org/GolfCourse
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/GolfCourse'])]
class GolfCourse extends SportsActivityLocation
{
}
