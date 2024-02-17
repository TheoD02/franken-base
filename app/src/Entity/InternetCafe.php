<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An internet cafe.
 *
 * @see https://schema.org/InternetCafe
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/InternetCafe'])]
class InternetCafe extends LocalBusiness
{
}
