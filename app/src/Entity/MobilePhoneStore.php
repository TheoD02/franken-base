<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A store that sells mobile phones and related accessories.
 *
 * @see https://schema.org/MobilePhoneStore
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MobilePhoneStore'])]
class MobilePhoneStore extends Store
{
}
