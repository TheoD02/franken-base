<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A property, used to indicate attributes and relationships of some Thing; equivalent to rdf:Property.
 *
 * @see https://schema.org/Property
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Property'])]
class Property extends Intangible
{
    /**
     * Relates a term (i.e. a property, class or enumeration) to one that supersedes it.
     *
     * @see https://schema.org/supersededBy
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Class_')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/supersededBy'])]
    #[Assert\NotNull]
    private Class_ $supersededBy;

    /**
     * @var Collection<Class_>|null relates a property to a class that constitutes (one of) the expected type(s) for values of the property
     *
     * @see https://schema.org/rangeIncludes
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Class_')]
    #[ORM\JoinTable(name: 'property_class_range_includes')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/rangeIncludes'])]
    private ?Collection $rangeIncludes = null;

    /**
     * @var Collection<Class_>|null relates a property to a class that is (one of) the type(s) the property is expected to be used on
     *
     * @see https://schema.org/domainIncludes
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Class_')]
    #[ORM\JoinTable(name: 'property_class_domain_includes')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/domainIncludes'])]
    private ?Collection $domainIncludes = null;

    /**
     * Relates a property to a property that is its inverse. Inverse properties relate the same pairs of items to each other, but in reversed direction. For example, the 'alumni' and 'alumniOf' properties are inverseOf each other. Some properties don't have explicit inverses; in these situations RDFa and JSON-LD syntax for reverse properties can be used.
     *
     * @see https://schema.org/inverseOf
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Property')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/inverseOf'])]
    #[Assert\NotNull]
    private Property $inverseOf;

    public function __construct()
    {
        $this->rangeIncludes = new ArrayCollection();
        $this->domainIncludes = new ArrayCollection();
    }

    public function setSupersededBy(Class_ $supersededBy): void
    {
        $this->supersededBy = $supersededBy;
    }

    public function getSupersededBy(): Class_
    {
        return $this->supersededBy;
    }

    public function addRangeInclud(Class_ $rangeInclud): void
    {
        $this->rangeIncludes[] = $rangeInclud;
    }

    public function removeRangeInclud(Class_ $rangeInclud): void
    {
        $this->rangeIncludes->removeElement($rangeInclud);
    }

    /**
     * @return Collection<Class_>|null
     */
    public function getRangeIncludes(): Collection
    {
        return $this->rangeIncludes;
    }

    public function addDomainInclud(Class_ $domainInclud): void
    {
        $this->domainIncludes[] = $domainInclud;
    }

    public function removeDomainInclud(Class_ $domainInclud): void
    {
        $this->domainIncludes->removeElement($domainInclud);
    }

    /**
     * @return Collection<Class_>|null
     */
    public function getDomainIncludes(): Collection
    {
        return $this->domainIncludes;
    }

    public function setInverseOf(Property $inverseOf): void
    {
        $this->inverseOf = $inverseOf;
    }

    public function getInverseOf(): Property
    {
        return $this->inverseOf;
    }
}
