<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Quiz: A test of knowledge, skills and abilities.
 *
 * @see https://schema.org/Quiz
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Quiz'])]
class Quiz extends LearningResource
{
}
