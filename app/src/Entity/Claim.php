<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A \[\[Claim\]\] in Schema.org represents a specific, factually-oriented claim that could be the \[\[itemReviewed\]\] in a \[\[ClaimReview\]\]. The content of a claim can be summarized with the \[\[text\]\] property. Variations on well known claims can have their common identity indicated via \[\[sameAs\]\] links, and summarized with a \[\[name\]\]. Ideally, a \[\[Claim\]\] description includes enough contextual information to minimize the risk of ambiguity or inclarity. In practice, many claims are better understood in the context in which they appear or the interpretations provided by claim reviews. Beyond \[\[ClaimReview\]\], the Claim type can be associated with related creative works - for example a \[\[ScholarlyArticle\]\] or \[\[Question\]\] might be \[\[about\]\] some \[\[Claim\]\]. At this time, Schema.org does not define any types of relationship between claims. This is a natural area for future exploration.
 *
 * @see https://schema.org/Claim
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Claim'])]
class Claim extends CreativeWork
{
    /**
     * Indicates the first known occurrence of a \[\[Claim\]\] in some \[\[CreativeWork\]\].
     *
     * @see https://schema.org/firstAppearance
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWork')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/firstAppearance'])]
    #[Assert\NotNull]
    private CreativeWork $firstAppearance;

    /**
     * For a \[\[Claim\]\] interpreted from \[\[MediaObject\]\] content sed to indicate a claim contained, implied or refined from the content of a \[\[MediaObject\]\].
     *
     * @see https://schema.org/claimInterpreter
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/claimInterpreter'])]
    #[Assert\NotNull]
    private Person $claimInterpreter;

    /**
     * Indicates an occurrence of a \[\[Claim\]\] in some \[\[CreativeWork\]\].
     *
     * @see https://schema.org/appearance
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWork')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/appearance'])]
    #[Assert\NotNull]
    private CreativeWork $appearance;

    public function setFirstAppearance(CreativeWork $firstAppearance): void
    {
        $this->firstAppearance = $firstAppearance;
    }

    public function getFirstAppearance(): CreativeWork
    {
        return $this->firstAppearance;
    }

    public function setClaimInterpreter(Person $claimInterpreter): void
    {
        $this->claimInterpreter = $claimInterpreter;
    }

    public function getClaimInterpreter(): Person
    {
        return $this->claimInterpreter;
    }

    public function setAppearance(CreativeWork $appearance): void
    {
        $this->appearance = $appearance;
    }

    public function getAppearance(): CreativeWork
    {
        return $this->appearance;
    }
}
