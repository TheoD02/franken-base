<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A \[\[comment\]\] that corrects \[\[CreativeWork\]\].
 *
 * @see https://schema.org/CorrectionComment
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/CorrectionComment'])]
class CorrectionComment extends Comment
{
}
