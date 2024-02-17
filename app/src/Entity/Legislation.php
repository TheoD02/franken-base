<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\Get;
use App\Enum\LegalForceStatus;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A legal document such as an act, decree, bill, etc. (enforceable or not) or a component of a legal act (like an article).
 *
 * @see https://schema.org/Legislation
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap(['legislation' => Legislation::class, 'legislationObject' => LegislationObject::class])]
class Legislation extends CreativeWork
{
    /**
     * Indicates that this legislation (or part of legislation) fulfills the objectives set by another legislation, by passing appropriate implementation measures. Typically, some legislations of European Union's member states or regions transpose European Directives. This indicates a legally binding link between the 2 legislations.
     *
     * @see https://schema.org/legislationTransposes
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Legislation')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/legislationTransposes'])]
    #[Assert\NotNull]
    private Legislation $legislationTransposes;

    /**
     * Indicates that this legislation (or part of a legislation) somehow transfers another legislation in a different legislative context. This is an informative link, and it has no legal value. For legally-binding links of transposition, use the [legislationTransposes](/legislationTransposes) property. For example an informative consolidated law of a European Union's member state "applies" the consolidated version of the European Directive implemented in it.
     *
     * @see https://schema.org/legislationApplies
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Legislation')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/legislationApplies'])]
    #[Assert\NotNull]
    private Legislation $legislationApplies;

    /**
     * Another legislation that this legislation changes. This encompasses the notions of amendment, replacement, correction, repeal, or other types of change. This may be a direct change (textual or non-textual amendment) or a consequential or indirect change. The property is to be used to express the existence of a change relationship between two acts rather than the existence of a consolidated version of the text that shows the result of the change. For consolidation relationships, use the [legislationConsolidates](/legislationConsolidates) property.
     *
     * @see https://schema.org/legislationChanges
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Legislation')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/legislationChanges'])]
    #[Assert\NotNull]
    private Legislation $legislationChanges;

    /**
     * An identifier for the legislation. This can be either a string-based identifier, like the CELEX at EU level or the NOR in France, or a web-based, URL/URI identifier, like an ELI (European Legislation Identifier) or an URN-Lex.
     *
     * @see https://schema.org/legislationIdentifier
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/legislationIdentifier'])]
    private ?string $legislationIdentifier = null;

    /**
     * The point-in-time at which the provided description of the legislation is valid (e.g.: when looking at the law on the 2016-04-07 (= dateVersion), I get the consolidation of 2015-04-12 of the "National Insurance Contributions Act 2015").
     *
     * @see https://schema.org/legislationDateVersion
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/legislationDateVersion'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $legislationDateVersion = null;

    /**
     * An individual or organization that has some kind of responsibility for the legislation. Typically the ministry who is/was in charge of elaborating the legislation, or the adressee for potential questions about the legislation once it is published.
     *
     * @see https://schema.org/legislationResponsible
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/legislationResponsible'])]
    #[Assert\NotNull]
    private Person $legislationResponsible;

    /**
     * The jurisdiction from which the legislation originates.
     *
     * @see https://schema.org/legislationJurisdiction
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\AdministrativeArea')]
    #[ApiProperty(types: ['https://schema.org/legislationJurisdiction'])]
    private ?AdministrativeArea $legislationJurisdiction = null;

    /**
     * Indicates a legal jurisdiction, e.g. of some legislation, or where some government service is based.
     *
     * @see https://schema.org/jurisdiction
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\AdministrativeArea')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/jurisdiction'])]
    #[Assert\NotNull]
    private AdministrativeArea $jurisdiction;

    /**
     * The person or organization that originally passed or made the law: typically parliament (for primary legislation) or government (for secondary legislation). This indicates the "legal author" of the law, as opposed to its physical author.
     *
     * @see https://schema.org/legislationPassedBy
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
    #[ApiProperty(types: ['https://schema.org/legislationPassedBy'])]
    private ?Organization $legislationPassedBy = null;

    /**
     * The type of the legislation. Examples of values are "law", "act", "directive", "decree", "regulation", "statutory instrument", "loi organique", "règlement grand-ducal", etc., depending on the country.
     *
     * @see https://schema.org/legislationType
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/legislationType'])]
    private ?string $legislationType = null;

    /**
     * Indicates another legislation taken into account in this consolidated legislation (which is usually the product of an editorial process that revises the legislation). This property should be used multiple times to refer to both the original version or the previous consolidated version, and to the legislations making the change.
     *
     * @see https://schema.org/legislationConsolidates
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Legislation')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/legislationConsolidates'])]
    #[Assert\NotNull]
    private Legislation $legislationConsolidates;

    /**
     * The date of adoption or signature of the legislation. This is the date at which the text is officially aknowledged to be a legislation, even though it might not even be published or in force.
     *
     * @see https://schema.org/legislationDate
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/legislationDate'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $legislationDate = null;

    /**
     * Whether the legislation is currently in force, not in force, or partially in force.
     *
     * @see https://schema.org/legislationLegalForce
     */
    #[ORM\Column]
    #[ApiProperty(types: ['https://schema.org/legislationLegalForce'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [LegalForceStatus::class, 'toArray'])]
    private string $legislationLegalForce;

    public function setLegislationTransposes(Legislation $legislationTransposes): void
    {
        $this->legislationTransposes = $legislationTransposes;
    }

    public function getLegislationTransposes(): Legislation
    {
        return $this->legislationTransposes;
    }

    public function setLegislationApplies(Legislation $legislationApplies): void
    {
        $this->legislationApplies = $legislationApplies;
    }

    public function getLegislationApplies(): Legislation
    {
        return $this->legislationApplies;
    }

    public function setLegislationChanges(Legislation $legislationChanges): void
    {
        $this->legislationChanges = $legislationChanges;
    }

    public function getLegislationChanges(): Legislation
    {
        return $this->legislationChanges;
    }

    public function setLegislationIdentifier(?string $legislationIdentifier): void
    {
        $this->legislationIdentifier = $legislationIdentifier;
    }

    public function getLegislationIdentifier(): ?string
    {
        return $this->legislationIdentifier;
    }

    public function setLegislationDateVersion(?\DateTimeInterface $legislationDateVersion): void
    {
        $this->legislationDateVersion = $legislationDateVersion;
    }

    public function getLegislationDateVersion(): ?\DateTimeInterface
    {
        return $this->legislationDateVersion;
    }

    public function setLegislationResponsible(Person $legislationResponsible): void
    {
        $this->legislationResponsible = $legislationResponsible;
    }

    public function getLegislationResponsible(): Person
    {
        return $this->legislationResponsible;
    }

    public function setLegislationJurisdiction(?AdministrativeArea $legislationJurisdiction): void
    {
        $this->legislationJurisdiction = $legislationJurisdiction;
    }

    public function getLegislationJurisdiction(): ?AdministrativeArea
    {
        return $this->legislationJurisdiction;
    }

    public function setJurisdiction(AdministrativeArea $jurisdiction): void
    {
        $this->jurisdiction = $jurisdiction;
    }

    public function getJurisdiction(): AdministrativeArea
    {
        return $this->jurisdiction;
    }

    public function setLegislationPassedBy(?Organization $legislationPassedBy): void
    {
        $this->legislationPassedBy = $legislationPassedBy;
    }

    public function getLegislationPassedBy(): ?Organization
    {
        return $this->legislationPassedBy;
    }

    public function setLegislationType(?string $legislationType): void
    {
        $this->legislationType = $legislationType;
    }

    public function getLegislationType(): ?string
    {
        return $this->legislationType;
    }

    public function setLegislationConsolidates(Legislation $legislationConsolidates): void
    {
        $this->legislationConsolidates = $legislationConsolidates;
    }

    public function getLegislationConsolidates(): Legislation
    {
        return $this->legislationConsolidates;
    }

    public function setLegislationDate(?\DateTimeInterface $legislationDate): void
    {
        $this->legislationDate = $legislationDate;
    }

    public function getLegislationDate(): ?\DateTimeInterface
    {
        return $this->legislationDate;
    }

    public function setLegislationLegalForce(string $legislationLegalForce): void
    {
        $this->legislationLegalForce = $legislationLegalForce;
    }

    public function getLegislationLegalForce(): string
    {
        return $this->legislationLegalForce;
    }
}
