<?php

namespace App\Enum;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use MyCLabs\Enum\Enum;

/**
 * A business entity type is a conceptual entity representing the legal form, the size, the main line of business, the position in the value chain, or any combination thereof, of an organization or business person.\\n\\nCommonly used values:\\n\\n\* http://purl.org/goodrelations/v1#Business\\n\* http://purl.org/goodrelations/v1#Enduser\\n\* http://purl.org/goodrelations/v1#PublicInstitution\\n\* http://purl.org/goodrelations/v1#Reseller
 *
 * @see https://schema.org/BusinessEntityType
 */
class BusinessEntityType extends Enum
{
}
