<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An email message.
 *
 * @see https://schema.org/EmailMessage
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/EmailMessage'])]
class EmailMessage extends Message
{
}
