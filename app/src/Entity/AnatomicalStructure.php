<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Any part of the human body, typically a component of an anatomical system. Organs, tissues, and cells are all anatomical structures.
 *
 * @see https://schema.org/AnatomicalStructure
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
    'anatomicalStructure' => AnatomicalStructure::class,
    'bone' => Bone::class,
    'ligament' => Ligament::class,
    'vessel' => Vessel::class,
    'brainStructure' => BrainStructure::class,
    'nerve' => Nerve::class,
    'joint' => Joint::class,
    'muscle' => Muscle::class,
    'artery' => Artery::class,
    'vein' => Vein::class,
    'lymphaticVessel' => LymphaticVessel::class,
])]
class AnatomicalStructure extends MedicalEntity
{
    /**
     * An image containing a diagram that illustrates the structure and/or its component substructures and/or connections with other structures.
     *
     * @see https://schema.org/diagram
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\ImageObject')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/diagram'])]
    #[Assert\NotNull]
    private ImageObject $diagram;

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
     * Location in the body of the anatomical structure.
     *
     * @see https://schema.org/bodyLocation
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/bodyLocation'])]
    private ?string $bodyLocation = null;

    /**
     * Other anatomical structures to which this structure is connected.
     *
     * @see https://schema.org/connectedTo
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\AnatomicalStructure')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/connectedTo'])]
    #[Assert\NotNull]
    private AnatomicalStructure $connectedTo;

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
     * @var Collection<AnatomicalStructure>|null component (sub-)structure(s) that comprise this anatomical structure
     *
     * @see https://schema.org/subStructure
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\AnatomicalStructure')]
    #[ORM\JoinTable(name: 'anatomical_structure_anatomical_structure_sub_structure')]
    #[ORM\InverseJoinColumn(name: 'sub_structure_anatomical_structure_id', unique: true)]
    #[ApiProperty(types: ['https://schema.org/subStructure'])]
    private ?Collection $subStructure = null;

    /**
     * The anatomical or organ system that this structure is part of.
     *
     * @see https://schema.org/partOfSystem
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\AnatomicalSystem')]
    #[ApiProperty(types: ['https://schema.org/partOfSystem'])]
    private ?AnatomicalSystem $partOfSystem = null;

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
        $this->subStructure = new ArrayCollection();
    }

    public function setDiagram(ImageObject $diagram): void
    {
        $this->diagram = $diagram;
    }

    public function getDiagram(): ImageObject
    {
        return $this->diagram;
    }

    public function setRelatedCondition(MedicalCondition $relatedCondition): void
    {
        $this->relatedCondition = $relatedCondition;
    }

    public function getRelatedCondition(): MedicalCondition
    {
        return $this->relatedCondition;
    }

    public function setBodyLocation(?string $bodyLocation): void
    {
        $this->bodyLocation = $bodyLocation;
    }

    public function getBodyLocation(): ?string
    {
        return $this->bodyLocation;
    }

    public function setConnectedTo(AnatomicalStructure $connectedTo): void
    {
        $this->connectedTo = $connectedTo;
    }

    public function getConnectedTo(): AnatomicalStructure
    {
        return $this->connectedTo;
    }

    public function setRelatedTherapy(MedicalTherapy $relatedTherapy): void
    {
        $this->relatedTherapy = $relatedTherapy;
    }

    public function getRelatedTherapy(): MedicalTherapy
    {
        return $this->relatedTherapy;
    }

    public function addSubStructure(AnatomicalStructure $subStructure): void
    {
        $this->subStructure[] = $subStructure;
    }

    public function removeSubStructure(AnatomicalStructure $subStructure): void
    {
        $this->subStructure->removeElement($subStructure);
    }

    /**
     * @return Collection<AnatomicalStructure>|null
     */
    public function getSubStructure(): Collection
    {
        return $this->subStructure;
    }

    public function setPartOfSystem(?AnatomicalSystem $partOfSystem): void
    {
        $this->partOfSystem = $partOfSystem;
    }

    public function getPartOfSystem(): ?AnatomicalSystem
    {
        return $this->partOfSystem;
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
