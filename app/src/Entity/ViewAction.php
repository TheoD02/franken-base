<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of consuming static visual content.
 *
 * @see https://schema.org/ViewAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ViewAction'])]
class ViewAction extends ConsumeAction
{
}
