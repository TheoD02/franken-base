<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use App\Enum\MedicalEvidenceLevel;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Any recommendation made by a standard society (e.g. ACC/AHA) or consensus statement that denotes how to diagnose and treat a particular condition. Note: this type should be used to tag the actual guideline recommendation; if the guideline recommendation occurs in a larger scholarly article, use MedicalScholarlyArticle to tag the overall article, not this type. Note also: the organization making the recommendation should be captured in the recognizingAuthority base property of MedicalEntity.
 *
 * @see https://schema.org/MedicalGuideline
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
    'medicalGuideline' => MedicalGuideline::class,
    'medicalGuidelineContraindication' => MedicalGuidelineContraindication::class,
    'medicalGuidelineRecommendation' => MedicalGuidelineRecommendation::class,
])]
class MedicalGuideline extends MedicalEntity
{
    /**
     * Source of the data used to formulate the guidance, e.g. RCT, consensus opinion, etc.
     *
     * @see https://schema.org/evidenceOrigin
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/evidenceOrigin'])]
    private ?string $evidenceOrigin = null;

    /**
     * Date on which this guideline's recommendation was made.
     *
     * @see https://schema.org/guidelineDate
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/guidelineDate'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $guidelineDate = null;

    /**
     * Strength of evidence of the data used to formulate the guideline (enumerated).
     *
     * @see https://schema.org/evidenceLevel
     */
    #[ORM\Column]
    #[ApiProperty(types: ['https://schema.org/evidenceLevel'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [MedicalEvidenceLevel::class, 'toArray'])]
    private string $evidenceLevel;

    /**
     * The medical conditions, treatments, etc. that are the subject of the guideline.
     *
     * @see https://schema.org/guidelineSubject
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MedicalEntity')]
    #[ApiProperty(types: ['https://schema.org/guidelineSubject'])]
    private ?MedicalEntity $guidelineSubject = null;

    public function setEvidenceOrigin(?string $evidenceOrigin): void
    {
        $this->evidenceOrigin = $evidenceOrigin;
    }

    public function getEvidenceOrigin(): ?string
    {
        return $this->evidenceOrigin;
    }

    public function setGuidelineDate(?\DateTimeInterface $guidelineDate): void
    {
        $this->guidelineDate = $guidelineDate;
    }

    public function getGuidelineDate(): ?\DateTimeInterface
    {
        return $this->guidelineDate;
    }

    public function setEvidenceLevel(string $evidenceLevel): void
    {
        $this->evidenceLevel = $evidenceLevel;
    }

    public function getEvidenceLevel(): string
    {
        return $this->evidenceLevel;
    }

    public function setGuidelineSubject(?MedicalEntity $guidelineSubject): void
    {
        $this->guidelineSubject = $guidelineSubject;
    }

    public function getGuidelineSubject(): ?MedicalEntity
    {
        return $this->guidelineSubject;
    }
}
