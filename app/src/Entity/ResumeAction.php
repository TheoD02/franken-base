<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of resuming a device or application which was formerly paused (e.g. resume music playback or resume a timer).
 *
 * @see https://schema.org/ResumeAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ResumeAction'])]
class ResumeAction extends ControlAction
{
}
