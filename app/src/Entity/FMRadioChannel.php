<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A radio channel that uses FM.
 *
 * @see https://schema.org/FMRadioChannel
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/FMRadioChannel'])]
class FMRadioChannel extends RadioChannel
{
}
