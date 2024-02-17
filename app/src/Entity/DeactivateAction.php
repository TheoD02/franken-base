<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of stopping or deactivating a device or application (e.g. stopping a timer or turning off a flashlight).
 *
 * @see https://schema.org/DeactivateAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DeactivateAction'])]
class DeactivateAction extends ControlAction
{
}
