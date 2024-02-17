<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of intentionally disregarding the object. An agent ignores an object.
 *
 * @see https://schema.org/IgnoreAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/IgnoreAction'])]
class IgnoreAction extends AssessAction
{
}
