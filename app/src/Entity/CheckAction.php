<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An agent inspects, determines, investigates, inquires, or examines an object's accuracy, quality, condition, or state.
 *
 * @see https://schema.org/CheckAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/CheckAction'])]
class CheckAction extends FindAction
{
}
