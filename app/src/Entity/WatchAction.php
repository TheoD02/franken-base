<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of consuming dynamic/moving visual content.
 *
 * @see https://schema.org/WatchAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/WatchAction'])]
class WatchAction extends ConsumeAction
{
}
