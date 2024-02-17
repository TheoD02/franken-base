<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A syllabus that describes the material covered in a course, often with several such sections per \[\[Course\]\] so that a distinct \[\[timeRequired\]\] can be provided for that section of the \[\[Course\]\].
 *
 * @see https://schema.org/Syllabus
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Syllabus'])]
class Syllabus extends LearningResource
{
}
