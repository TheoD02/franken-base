<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A class, also often called a 'Type'; equivalent to rdfs:Class.
 *
 * @see https://schema.org/Class
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap(['class' => Class_::class, 'dataType' => DataType::class])]
class Class_ extends Intangible
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

    public function setSupersededBy(Class_ $supersededBy): void
    {
        $this->supersededBy = $supersededBy;
    }

    public function getSupersededBy(): Class_
    {
        return $this->supersededBy;
    }
}
