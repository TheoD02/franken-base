<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Any bodily activity that enhances or maintains physical fitness and overall health and wellness. Includes activity that is part of daily living and routine, structured exercise, and exercise prescribed as part of a medical treatment or recovery plan.
 *
 * @see https://schema.org/PhysicalActivity
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PhysicalActivity'])]
class PhysicalActivity extends LifestyleModification
{
    /**
     * The characteristics of associated patients, such as age, gender, race etc.
     *
     * @see https://schema.org/epidemiology
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/epidemiology'])]
    private ?string $epidemiology = null;

    /**
     * Changes in the normal mechanical, physical, and biochemical functions that are associated with this activity or condition.
     *
     * @see https://schema.org/pathophysiology
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/pathophysiology'])]
    private ?string $pathophysiology = null;

    /**
     * @var Collection<Text>|null A category for the item. Greater signs or slashes can be used to informally indicate a category hierarchy.
     *
     * @see https://schema.org/category
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'physical_activity_text_category')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/category'])]
    private ?Collection $category = null;

    /**
     * The anatomy of the underlying organ system or structures associated with this entity.
     *
     * @see https://schema.org/associatedAnatomy
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\AnatomicalSystem')]
    #[ApiProperty(types: ['https://schema.org/associatedAnatomy'])]
    private ?AnatomicalSystem $associatedAnatomy = null;

    public function __construct()
    {
        $this->category = new ArrayCollection();
    }

    public function setEpidemiology(?string $epidemiology): void
    {
        $this->epidemiology = $epidemiology;
    }

    public function getEpidemiology(): ?string
    {
        return $this->epidemiology;
    }

    public function setPathophysiology(?string $pathophysiology): void
    {
        $this->pathophysiology = $pathophysiology;
    }

    public function getPathophysiology(): ?string
    {
        return $this->pathophysiology;
    }

    public function addCategory(string $category): void
    {
        $this->category[] = $category;
    }

    public function removeCategory(string $category): void
    {
        $this->category->removeElement($category);
    }

    /**
     * @return Collection<Text>|null
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function setAssociatedAnatomy(?AnatomicalSystem $associatedAnatomy): void
    {
        $this->associatedAnatomy = $associatedAnatomy;
    }

    public function getAssociatedAnatomy(): ?AnatomicalSystem
    {
        return $this->associatedAnatomy;
    }
}
