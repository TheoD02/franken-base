<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An apartment (in American English) or flat (in British English) is a self-contained housing unit (a type of residential real estate) that occupies only part of a building (source: Wikipedia, the free encyclopedia, see <http://en.wikipedia.org/wiki/Apartment>).
 *
 * @see https://schema.org/Apartment
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Apartment'])]
class Apartment extends Accommodation
{
    public function __construct()
    {
        parent::__construct();
    }
}
