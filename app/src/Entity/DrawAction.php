<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of producing a visual/graphical representation of an object, typically with a pen/pencil and paper as instruments.
 *
 * @see https://schema.org/DrawAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DrawAction'])]
class DrawAction extends CreateAction
{
}
