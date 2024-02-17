<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of swallowing solid objects.
 *
 * @see https://schema.org/EatAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/EatAction'])]
class EatAction extends ConsumeAction
{
}
