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
 * An anatomical system is a group of anatomical structures that work together to perform a certain task. Anatomical systems, such as organ systems, are one organizing principle of anatomy, and can include circulatory, digestive, endocrine, integumentary, immune, lymphatic, muscular, nervous, reproductive, respiratory, skeletal, urinary, vestibular, and other systems.
 *
 * @see https://schema.org/AnatomicalSystem
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/AnatomicalSystem'])]
class AnatomicalSystem extends MedicalEntity
{
    /**
     * A medical condition associated with this anatomy.
     *
     * @see https://schema.org/relatedCondition
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MedicalCondition')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/relatedCondition'])]
    #[Assert\NotNull]
    private MedicalCondition $relatedCondition;

    /**
     * Specifying something physically contained by something else. Typically used here for the underlying anatomical structures, such as organs, that comprise the anatomical system.
     *
     * @see https://schema.org/comprisedOf
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\AnatomicalSystem')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/comprisedOf'])]
    #[Assert\NotNull]
    private AnatomicalSystem $comprisedOf;

    /**
     * A medical therapy related to this anatomy.
     *
     * @see https://schema.org/relatedTherapy
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MedicalTherapy')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/relatedTherapy'])]
    #[Assert\NotNull]
    private MedicalTherapy $relatedTherapy;

    /**
     * @var Collection<AnatomicalStructure>|null related anatomical structure(s) that are not part of the system but relate or connect to it, such as vascular bundles associated with an organ system
     *
     * @see https://schema.org/relatedStructure
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\AnatomicalStructure')]
    #[ORM\JoinTable(name: 'anatomical_system_anatomical_structure_related_structure')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/relatedStructure'])]
    private ?Collection $relatedStructure = null;

    /**
     * If applicable, a description of the pathophysiology associated with the anatomical system, including potential abnormal changes in the mechanical, physical, and biochemical functions of the system.
     *
     * @see https://schema.org/associatedPathophysiology
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/associatedPathophysiology'])]
    private ?string $associatedPathophysiology = null;

    public function __construct()
    {
        $this->relatedStructure = new ArrayCollection();
    }

    public function setRelatedCondition(MedicalCondition $relatedCondition): void
    {
        $this->relatedCondition = $relatedCondition;
    }

    public function getRelatedCondition(): MedicalCondition
    {
        return $this->relatedCondition;
    }

    public function setComprisedOf(AnatomicalSystem $comprisedOf): void
    {
        $this->comprisedOf = $comprisedOf;
    }

    public function getComprisedOf(): AnatomicalSystem
    {
        return $this->comprisedOf;
    }

    public function setRelatedTherapy(MedicalTherapy $relatedTherapy): void
    {
        $this->relatedTherapy = $relatedTherapy;
    }

    public function getRelatedTherapy(): MedicalTherapy
    {
        return $this->relatedTherapy;
    }

    public function addRelatedStructure(AnatomicalStructure $relatedStructure): void
    {
        $this->relatedStructure[] = $relatedStructure;
    }

    public function removeRelatedStructure(AnatomicalStructure $relatedStructure): void
    {
        $this->relatedStructure->removeElement($relatedStructure);
    }

    /**
     * @return Collection<AnatomicalStructure>|null
     */
    public function getRelatedStructure(): Collection
    {
        return $this->relatedStructure;
    }

    public function setAssociatedPathophysiology(?string $associatedPathophysiology): void
    {
        $this->associatedPathophysiology = $associatedPathophysiology;
    }

    public function getAssociatedPathophysiology(): ?string
    {
        return $this->associatedPathophysiology;
    }
}
