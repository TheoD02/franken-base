<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * One or more messages between organizations or people on a particular topic. Individual messages can be linked to the conversation with isPartOf or hasPart properties.
 *
 * @see https://schema.org/Conversation
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Conversation'])]
class Conversation extends CreativeWork
{
}
