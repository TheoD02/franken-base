<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of reaching a draw in a competitive activity.
 *
 * @see https://schema.org/TieAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TieAction'])]
class TieAction extends AchieveAction
{
}
