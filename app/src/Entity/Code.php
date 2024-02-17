<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Computer programming source code. Example: Full (compile ready) solutions, code snippet samples, scripts, templates.
 *
 * @see https://schema.org/Code
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Code'])]
class Code extends CreativeWork
{
}
