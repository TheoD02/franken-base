<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of consuming audio content.
 *
 * @see https://schema.org/ListenAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ListenAction'])]
class ListenAction extends ConsumeAction
{
}
