<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A \[hackathon\](https://en.wikipedia.org/wiki/Hackathon) event.
 *
 * @see https://schema.org/Hackathon
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Hackathon'])]
class Hackathon extends Event
{
}
