<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * UserInteraction and its subtypes is an old way of talking about users interacting with pages. It is generally better to use \[\[Action\]\]-based vocabulary, alongside types such as \[\[Comment\]\].
 *
 * @see https://schema.org/UserPlays
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/UserPlays'])]
class UserPlays extends UserInteraction
{
}
