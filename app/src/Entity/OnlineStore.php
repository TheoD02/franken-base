<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An eCommerce site.
 *
 * @see https://schema.org/OnlineStore
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/OnlineStore'])]
class OnlineStore extends OnlineBusiness
{
}
