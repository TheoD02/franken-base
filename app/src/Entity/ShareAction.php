<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of distributing content to people for their amusement or edification.
 *
 * @see https://schema.org/ShareAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ShareAction'])]
class ShareAction extends CommunicateAction
{
}
