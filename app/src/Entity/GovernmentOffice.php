<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A government office—for example, an IRS or DMV office.
 *
 * @see https://schema.org/GovernmentOffice
 */
#[ORM\MappedSuperclass]
abstract class GovernmentOffice extends LocalBusiness
{
}
