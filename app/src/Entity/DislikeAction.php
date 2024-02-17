<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of expressing a negative sentiment about the object. An agent dislikes an object (a proposition, topic or theme) with participants.
 *
 * @see https://schema.org/DislikeAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DislikeAction'])]
class DislikeAction extends ReactAction
{
}
