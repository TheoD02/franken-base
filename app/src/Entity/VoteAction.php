<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The act of expressing a preference from a fixed/finite/structured set of choices/options.
 *
 * @see https://schema.org/VoteAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/VoteAction'])]
class VoteAction extends ChooseAction
{
    /**
     * A sub property of object. The candidate subject of this action.
     *
     * @see https://schema.org/candidate
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/candidate'])]
    #[Assert\NotNull]
    private Person $candidate;

    public function setCandidate(Person $candidate): void
    {
        $this->candidate = $candidate;
    }

    public function getCandidate(): Person
    {
        return $this->candidate;
    }
}
