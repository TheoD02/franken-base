<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A state or province of a country.
 *
 * @see https://schema.org/State
 */
#[ORM\Entity]
#[ORM\Table(name: '`state`')]
#[ApiResource(types: ['https://schema.org/State'])]
class State extends AdministrativeArea
{
}
