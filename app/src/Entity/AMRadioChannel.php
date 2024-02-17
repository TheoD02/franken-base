<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A radio channel that uses AM.
 *
 * @see https://schema.org/AMRadioChannel
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/AMRadioChannel'])]
class AMRadioChannel extends RadioChannel
{
}
