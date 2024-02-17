<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A gym.
 *
 * @see https://schema.org/ExerciseGym
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ExerciseGym'])]
class ExerciseGym extends SportsActivityLocation
{
}
