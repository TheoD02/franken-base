<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of expressing a desire about the object. An agent wants an object.
 *
 * @see https://schema.org/WantAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/WantAction'])]
class WantAction extends ReactAction
{
}
