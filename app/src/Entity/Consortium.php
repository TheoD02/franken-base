<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Consortium is a membership \[\[Organization\]\] whose members are typically Organizations.
 *
 * @see https://schema.org/Consortium
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Consortium'])]
class Consortium extends Organization
{
}
