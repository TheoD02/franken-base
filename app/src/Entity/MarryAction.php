<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of marrying a person.
 *
 * @see https://schema.org/MarryAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MarryAction'])]
class MarryAction extends InteractAction
{
}
