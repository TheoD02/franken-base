<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A statement about something, for example a fun or interesting fact. If known, the main entity this statement is about can be indicated using mainEntity. For more formal claims (e.g. in Fact Checking), consider using \[\[Claim\]\] instead. Use the \[\[text\]\] property to capture the text of the statement.
 *
 * @see https://schema.org/Statement
 */
#[ORM\Entity]
#[ORM\Table(name: '`statement`')]
#[ApiResource(types: ['https://schema.org/Statement'])]
class Statement extends CreativeWork
{
}
