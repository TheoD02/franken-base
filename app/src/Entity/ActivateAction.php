<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of starting or activating a device or application (e.g. starting a timer or turning on a flashlight).
 *
 * @see https://schema.org/ActivateAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ActivateAction'])]
class ActivateAction extends ControlAction
{
}
