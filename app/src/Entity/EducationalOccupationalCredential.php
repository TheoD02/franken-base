<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An educational or occupational credential. A diploma, academic degree, certification, qualification, badge, etc., that may be awarded to a person or other entity that meets the requirements defined by the credentialer.
 *
 * @see https://schema.org/EducationalOccupationalCredential
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/EducationalOccupationalCredential'])]
class EducationalOccupationalCredential extends CreativeWork
{
    /**
     * The category or type of credential being described, for example "degree”, “certificate”, “badge”, or more specific term.
     *
     * @see https://schema.org/credentialCategory
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\DefinedTerm')]
    #[ApiProperty(types: ['https://schema.org/credentialCategory'])]
    private ?DefinedTerm $credentialCategory = null;

    /**
     * The duration of validity of a permit or similar thing.
     *
     * @see https://schema.org/validFor
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Duration')]
    #[ApiProperty(types: ['https://schema.org/validFor'])]
    private ?Duration $validFor = null;

    /**
     * Knowledge, skill, ability or personal attribute that must be demonstrated by a person or other entity in order to do something such as earn an Educational Occupational Credential or understand a LearningResource.
     *
     * @see https://schema.org/competencyRequired
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/competencyRequired'])]
    private ?string $competencyRequired = null;

    /**
     * The geographic area where the item is valid. Applies for example to a \[\[Permit\]\], a \[\[Certification\]\], or an \[\[EducationalOccupationalCredential\]\].
     *
     * @see https://schema.org/validIn
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\AdministrativeArea')]
    #[ApiProperty(types: ['https://schema.org/validIn'])]
    private ?AdministrativeArea $validIn = null;

    /**
     * An organization that acknowledges the validity, value or utility of a credential. Note: recognition may include a process of quality assurance or accreditation.
     *
     * @see https://schema.org/recognizedBy
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/recognizedBy'])]
    #[Assert\NotNull]
    private Organization $recognizedBy;

    public function setCredentialCategory(?DefinedTerm $credentialCategory): void
    {
        $this->credentialCategory = $credentialCategory;
    }

    public function getCredentialCategory(): ?DefinedTerm
    {
        return $this->credentialCategory;
    }

    public function setValidFor(?Duration $validFor): void
    {
        $this->validFor = $validFor;
    }

    public function getValidFor(): ?Duration
    {
        return $this->validFor;
    }

    public function setCompetencyRequired(?string $competencyRequired): void
    {
        $this->competencyRequired = $competencyRequired;
    }

    public function getCompetencyRequired(): ?string
    {
        return $this->competencyRequired;
    }

    public function setValidIn(?AdministrativeArea $validIn): void
    {
        $this->validIn = $validIn;
    }

    public function getValidIn(): ?AdministrativeArea
    {
        return $this->validIn;
    }

    public function setRecognizedBy(Organization $recognizedBy): void
    {
        $this->recognizedBy = $recognizedBy;
    }

    public function getRecognizedBy(): Organization
    {
        return $this->recognizedBy;
    }
}
