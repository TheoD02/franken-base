<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A computer store.
 *
 * @see https://schema.org/ComputerStore
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ComputerStore'])]
class ComputerStore extends Store
{
}
