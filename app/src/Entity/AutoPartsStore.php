<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An auto parts store.
 *
 * @see https://schema.org/AutoPartsStore
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/AutoPartsStore'])]
class AutoPartsStore extends AutomotiveBusiness
{
}
