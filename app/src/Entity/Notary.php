<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A notary.
 *
 * @see https://schema.org/Notary
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Notary'])]
class Notary extends LegalService
{
}
