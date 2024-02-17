<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of searching for an object.\\n\\nRelated actions:\\n\\n\* \[\[FindAction\]\]: SearchAction generally leads to a FindAction, but not necessarily.
 *
 * @see https://schema.org/SearchAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SearchAction'])]
class SearchAction extends Action
{
    /**
     * A sub property of instrument. The query used on this action.
     *
     * @see https://schema.org/query
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/query'])]
    private ?string $query = null;

    public function setQuery(?string $query): void
    {
        $this->query = $query;
    }

    public function getQuery(): ?string
    {
        return $this->query;
    }
}
