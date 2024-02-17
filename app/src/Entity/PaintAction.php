<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of producing a painting, typically with paint and canvas as instruments.
 *
 * @see https://schema.org/PaintAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PaintAction'])]
class PaintAction extends CreateAction
{
}
