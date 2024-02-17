<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A self-storage facility.
 *
 * @see https://schema.org/SelfStorage
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SelfStorage'])]
class SelfStorage extends LocalBusiness
{
}
