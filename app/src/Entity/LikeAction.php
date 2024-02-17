<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of expressing a positive sentiment about the object. An agent likes an object (a proposition, topic or theme) with participants.
 *
 * @see https://schema.org/LikeAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/LikeAction'])]
class LikeAction extends ReactAction
{
}
