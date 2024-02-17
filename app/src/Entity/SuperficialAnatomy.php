<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Anatomical features that can be observed by sight (without dissection), including the form and proportions of the human body as well as surface landmarks that correspond to deeper subcutaneous structures. Superficial anatomy plays an important role in sports medicine, phlebotomy, and other medical specialties as underlying anatomical structures can be identified through surface palpation. For example, during back surgery, superficial anatomy can be used to palpate and count vertebrae to find the site of incision. Or in phlebotomy, superficial anatomy can be used to locate an underlying vein; for example, the median cubital vein can be located by palpating the borders of the cubital fossa (such as the epicondyles of the humerus) and then looking for the superficial signs of the vein, such as size, prominence, ability to refill after depression, and feel of surrounding tissue support. As another example, in a subluxation (dislocation) of the glenohumeral joint, the bony structure becomes pronounced with the deltoid muscle failing to cover the glenohumeral joint allowing the edges of the scapula to be superficially visible. Here, the superficial anatomy is the visible edges of the scapula, implying the underlying dislocation of the joint (the related anatomical structure).
 *
 * @see https://schema.org/SuperficialAnatomy
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SuperficialAnatomy'])]
class SuperficialAnatomy extends MedicalEntity
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
     * Anatomical systems or structures that relate to the superficial anatomy.
     *
     * @see https://schema.org/relatedAnatomy
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\AnatomicalSystem')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/relatedAnatomy'])]
    #[Assert\NotNull]
    private AnatomicalSystem $relatedAnatomy;

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
     * The significance associated with the superficial anatomy; as an example, how characteristics of the superficial anatomy can suggest underlying medical conditions or courses of treatment.
     *
     * @see https://schema.org/significance
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/significance'])]
    private ?string $significance = null;

    /**
     * If applicable, a description of the pathophysiology associated with the anatomical system, including potential abnormal changes in the mechanical, physical, and biochemical functions of the system.
     *
     * @see https://schema.org/associatedPathophysiology
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/associatedPathophysiology'])]
    private ?string $associatedPathophysiology = null;

    public function setRelatedCondition(MedicalCondition $relatedCondition): void
    {
        $this->relatedCondition = $relatedCondition;
    }

    public function getRelatedCondition(): MedicalCondition
    {
        return $this->relatedCondition;
    }

    public function setRelatedAnatomy(AnatomicalSystem $relatedAnatomy): void
    {
        $this->relatedAnatomy = $relatedAnatomy;
    }

    public function getRelatedAnatomy(): AnatomicalSystem
    {
        return $this->relatedAnatomy;
    }

    public function setRelatedTherapy(MedicalTherapy $relatedTherapy): void
    {
        $this->relatedTherapy = $relatedTherapy;
    }

    public function getRelatedTherapy(): MedicalTherapy
    {
        return $this->relatedTherapy;
    }

    public function setSignificance(?string $significance): void
    {
        $this->significance = $significance;
    }

    public function getSignificance(): ?string
    {
        return $this->significance;
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
