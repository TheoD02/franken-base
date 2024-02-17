<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Workers Union (also known as a Labor Union, Labour Union, or Trade Union) is an organization that promotes the interests of its worker members by collectively bargaining with management, organizing, and political lobbying.
 *
 * @see https://schema.org/WorkersUnion
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/WorkersUnion'])]
class WorkersUnion extends Organization
{
}
