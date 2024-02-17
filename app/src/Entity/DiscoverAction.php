<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of discovering/finding an object.
 *
 * @see https://schema.org/DiscoverAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DiscoverAction'])]
class DiscoverAction extends FindAction
{
}
