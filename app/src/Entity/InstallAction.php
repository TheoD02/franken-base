<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of installing an application.
 *
 * @see https://schema.org/InstallAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/InstallAction'])]
class InstallAction extends ConsumeAction
{
}
