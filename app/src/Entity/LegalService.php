<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A LegalService is a business that provides legally-oriented services, advice and representation, e.g. law firms.\\n\\nAs a \[\[LocalBusiness\]\] it can be described as a \[\[provider\]\] of one or more \[\[Service\]\]\\(s).
 *
 * @see https://schema.org/LegalService
 */
#[ORM\MappedSuperclass]
abstract class LegalService extends LocalBusiness
{
}
