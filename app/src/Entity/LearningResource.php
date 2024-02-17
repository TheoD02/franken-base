<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;

/**
 * The LearningResource type can be used to indicate \[\[CreativeWork\]\]s (whether physical or digital) that have a particular and explicit orientation towards learning, education, skill acquisition, and other educational purposes. \[\[LearningResource\]\] is expected to be used as an addition to a primary type such as \[\[Book\]\], \[\[VideoObject\]\], \[\[Product\]\] etc. \[\[EducationEvent\]\] serves a similar purpose for event-like things (e.g. a \[\[Trip\]\]). A \[\[LearningResource\]\] may be created as a result of an \[\[EducationEvent\]\], for example by recording one.
 *
 * @see https://schema.org/LearningResource
 */
#[ORM\MappedSuperclass]
abstract class LearningResource extends CreativeWork
{
    /**
     * Knowledge, skill, ability or personal attribute that must be demonstrated by a person or other entity in order to do something such as earn an Educational Occupational Credential or understand a LearningResource.
     *
     * @see https://schema.org/competencyRequired
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/competencyRequired'])]
    private ?string $competencyRequired = null;

    public function setCompetencyRequired(?string $competencyRequired): void
    {
        $this->competencyRequired = $competencyRequired;
    }

    public function getCompetencyRequired(): ?string
    {
        return $this->competencyRequired;
    }
}
