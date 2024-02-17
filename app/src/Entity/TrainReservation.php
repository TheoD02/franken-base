<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A reservation for train travel.\\n\\nNote: This type is for information about actual reservations, e.g. in confirmation emails or HTML pages with individual confirmations of reservations. For offers of tickets, use \[\[Offer\]\].
 *
 * @see https://schema.org/TrainReservation
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TrainReservation'])]
class TrainReservation extends Reservation
{
}
