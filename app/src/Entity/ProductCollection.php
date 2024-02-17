<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * A set of products (either \[\[ProductGroup\]\]s or specific variants) that are listed together e.g. in an \[\[Offer\]\].
 *
 * @see https://schema.org/ProductCollection
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ProductCollection'])]
class ProductCollection extends Collection_
{
    /**
     * @var Collection<TypeAndQuantityNode>|null this links to a node or nodes indicating the exact quantity of the products included in an \[\[Offer\]\] or \[\[ProductCollection\]\]
     *
     * @see https://schema.org/includesObject
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\TypeAndQuantityNode')]
    #[ORM\JoinTable(name: 'product_collection_type_and_quantity_node_includes_object')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/includesObject'])]
    private ?Collection $includesObject = null;

    public function __construct()
    {
        $this->includesObject = new ArrayCollection();
    }

    public function addIncludesObject(TypeAndQuantityNode $includesObject): void
    {
        $this->includesObject[] = $includesObject;
    }

    public function removeIncludesObject(TypeAndQuantityNode $includesObject): void
    {
        $this->includesObject->removeElement($includesObject);
    }

    /**
     * @return Collection<TypeAndQuantityNode>|null
     */
    public function getIncludesObject(): Collection
    {
        return $this->includesObject;
    }
}
