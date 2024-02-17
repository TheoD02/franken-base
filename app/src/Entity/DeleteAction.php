<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of editing a recipient by removing one of its objects.
 *
 * @see https://schema.org/DeleteAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DeleteAction'])]
class DeleteAction extends UpdateAction
{
}
