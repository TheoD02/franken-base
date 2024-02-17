<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of consuming written content.
 *
 * @see https://schema.org/ReadAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ReadAction'])]
class ReadAction extends ConsumeAction
{
}
