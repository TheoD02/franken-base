<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use Doctrine\ORM\Mapping as ORM;

/**
 * A post office.
 *
 * @see https://schema.org/PostOffice
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PostOffice'])]
class PostOffice extends GovernmentOffice
{
}
