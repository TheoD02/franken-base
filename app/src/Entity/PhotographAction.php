<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of capturing still images of objects using a camera.
 *
 * @see https://schema.org/PhotographAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PhotographAction'])]
class PhotographAction extends CreateAction
{
}
