<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of downloading an object.
 *
 * @see https://schema.org/DownloadAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DownloadAction'])]
class DownloadAction extends TransferAction
{
}
