<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Used to describe membership in a loyalty programs (e.g. "StarAliance"), traveler clubs (e.g. "AAA"), purchase clubs ("Safeway Club"), etc.
 *
 * @see https://schema.org/ProgramMembership
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ProgramMembership'])]
class ProgramMembership extends Intangible
{
    /**
     * A member of an Organization or a ProgramMembership. Organizations can be members of organizations; ProgramMembership is typically for individuals.
     *
     * @see https://schema.org/member
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/member'])]
    #[Assert\NotNull]
    private Person $member;

    /**
     * A unique identifier for the membership.
     *
     * @see https://schema.org/membershipNumber
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/membershipNumber'])]
    private ?string $membershipNumber = null;

    /**
     * The program providing the membership.
     *
     * @see https://schema.org/programName
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/programName'])]
    private ?string $programName = null;

    /**
     * The organization (airline, travelers' club, etc.) the membership is made with.
     *
     * @see https://schema.org/hostingOrganization
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
    #[ApiProperty(types: ['https://schema.org/hostingOrganization'])]
    private ?Organization $hostingOrganization = null;

    /**
     * The number of membership points earned by the member. If necessary, the unitText can be used to express the units the points are issued in. (E.g. stars, miles, etc.).
     *
     * @see https://schema.org/membershipPointsEarned
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/membershipPointsEarned'])]
    private ?string $membershipPointsEarned = null;

    public function setMember(Person $member): void
    {
        $this->member = $member;
    }

    public function getMember(): Person
    {
        return $this->member;
    }

    public function setMembershipNumber(?string $membershipNumber): void
    {
        $this->membershipNumber = $membershipNumber;
    }

    public function getMembershipNumber(): ?string
    {
        return $this->membershipNumber;
    }

    public function setProgramName(?string $programName): void
    {
        $this->programName = $programName;
    }

    public function getProgramName(): ?string
    {
        return $this->programName;
    }

    public function setHostingOrganization(?Organization $hostingOrganization): void
    {
        $this->hostingOrganization = $hostingOrganization;
    }

    public function getHostingOrganization(): ?Organization
    {
        return $this->hostingOrganization;
    }

    public function setMembershipPointsEarned(?string $membershipPointsEarned): void
    {
        $this->membershipPointsEarned = $membershipPointsEarned;
    }

    public function getMembershipPointsEarned(): ?string
    {
        return $this->membershipPointsEarned;
    }
}
