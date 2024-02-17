<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A reservation for boat travel. Note: This type is for information about actual reservations, e.g. in confirmation emails or HTML pages with individual confirmations of reservations. For offers of tickets, use \[\[Offer\]\].
 *
 * @see https://schema.org/BoatReservation
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/BoatReservation'])]
class BoatReservation extends Reservation
{
}
