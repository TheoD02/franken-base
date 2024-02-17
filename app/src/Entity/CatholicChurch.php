<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Catholic church.
 *
 * @see https://schema.org/CatholicChurch
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/CatholicChurch'])]
class CatholicChurch extends Church
{
}
