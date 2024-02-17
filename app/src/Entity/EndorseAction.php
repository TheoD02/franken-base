<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An agent approves/certifies/likes/supports/sanctions an object.
 *
 * @see https://schema.org/EndorseAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/EndorseAction'])]
class EndorseAction extends ReactAction
{
    /**
     * A sub property of participant. The person/organization being supported.
     *
     * @see https://schema.org/endorsee
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/endorsee'])]
    #[Assert\NotNull]
    private Organization $endorsee;

    public function setEndorsee(Organization $endorsee): void
    {
        $this->endorsee = $endorsee;
    }

    public function getEndorsee(): Organization
    {
        return $this->endorsee;
    }
}
