<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A News/Media organization such as a newspaper or TV station.
 *
 * @see https://schema.org/NewsMediaOrganization
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/NewsMediaOrganization'])]
class NewsMediaOrganization extends Organization
{
    /**
     * For a \[\[NewsMediaOrganization\]\], a link to the masthead page or a page listing top editorial management.
     *
     * @see https://schema.org/masthead
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWork')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/masthead'])]
    #[Assert\NotNull]
    private CreativeWork $masthead;

    /**
     * For a \[\[NewsMediaOrganization\]\] or other news-related \[\[Organization\]\], a statement explaining when authors of articles are not named in bylines.
     *
     * @see https://schema.org/noBylinesPolicy
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
    #[ApiProperty(types: ['https://schema.org/noBylinesPolicy'])]
    #[Assert\Url]
    private ?string $noBylinesPolicy = null;

    /**
     * Disclosure about verification and fact-checking processes for a \[\[NewsMediaOrganization\]\] or other fact-checking \[\[Organization\]\].
     *
     * @see https://schema.org/verificationFactCheckingPolicy
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
    #[ApiProperty(types: ['https://schema.org/verificationFactCheckingPolicy'])]
    #[Assert\Url]
    private ?string $verificationFactCheckingPolicy = null;

    /**
     * For a \[\[NewsMediaOrganization\]\], a statement on coverage priorities, including any public agenda or stance on issues.
     *
     * @see https://schema.org/missionCoveragePrioritiesPolicy
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
    #[ApiProperty(types: ['https://schema.org/missionCoveragePrioritiesPolicy'])]
    #[Assert\Url]
    private ?string $missionCoveragePrioritiesPolicy = null;

    public function setMasthead(CreativeWork $masthead): void
    {
        $this->masthead = $masthead;
    }

    public function getMasthead(): CreativeWork
    {
        return $this->masthead;
    }

    public function setNoBylinesPolicy(?string $noBylinesPolicy): void
    {
        $this->noBylinesPolicy = $noBylinesPolicy;
    }

    public function getNoBylinesPolicy(): ?string
    {
        return $this->noBylinesPolicy;
    }

    public function setVerificationFactCheckingPolicy(?string $verificationFactCheckingPolicy): void
    {
        $this->verificationFactCheckingPolicy = $verificationFactCheckingPolicy;
    }

    public function getVerificationFactCheckingPolicy(): ?string
    {
        return $this->verificationFactCheckingPolicy;
    }

    public function setMissionCoveragePrioritiesPolicy(?string $missionCoveragePrioritiesPolicy): void
    {
        $this->missionCoveragePrioritiesPolicy = $missionCoveragePrioritiesPolicy;
    }

    public function getMissionCoveragePrioritiesPolicy(): ?string
    {
        return $this->missionCoveragePrioritiesPolicy;
    }
}
