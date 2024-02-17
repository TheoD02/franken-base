<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of inserting at the end if an ordered collection.
 *
 * @see https://schema.org/AppendAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/AppendAction'])]
class AppendAction extends InsertAction
{
}
