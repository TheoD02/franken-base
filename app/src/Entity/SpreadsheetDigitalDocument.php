<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A spreadsheet file.
 *
 * @see https://schema.org/SpreadsheetDigitalDocument
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SpreadsheetDigitalDocument'])]
class SpreadsheetDigitalDocument extends DigitalDocument
{
}
