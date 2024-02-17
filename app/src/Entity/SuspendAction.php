<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of momentarily pausing a device or application (e.g. pause music playback or pause a timer).
 *
 * @see https://schema.org/SuspendAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SuspendAction'])]
class SuspendAction extends ControlAction
{
}
