<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An image of a visual machine-readable code such as a barcode or QR code.
 *
 * @see https://schema.org/Barcode
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Barcode'])]
class Barcode extends ImageObject
{
}
