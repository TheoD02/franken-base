<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of expressing a consistency of opinion with the object. An agent agrees to/about an object (a proposition, topic or theme) with participants.
 *
 * @see https://schema.org/AgreeAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/AgreeAction'])]
class AgreeAction extends ReactAction
{
}
