<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A department store.
 *
 * @see https://schema.org/DepartmentStore
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DepartmentStore'])]
class DepartmentStore extends Store
{
}
