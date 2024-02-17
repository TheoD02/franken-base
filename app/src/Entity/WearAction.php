<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of dressing oneself in clothing.
 *
 * @see https://schema.org/WearAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/WearAction'])]
class WearAction extends UseAction
{
}
