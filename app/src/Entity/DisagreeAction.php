<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of expressing a difference of opinion with the object. An agent disagrees to/about an object (a proposition, topic or theme) with participants.
 *
 * @see https://schema.org/DisagreeAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DisagreeAction'])]
class DisagreeAction extends ReactAction
{
}
