<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use App\Enum\GenderType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A person (alive, dead, undead, or fictional).
 *
 * @see https://schema.org/Person
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap(['person' => Person::class, 'patient' => Patient::class])]
class Person extends Thing
{
    /**
     * A contact location for a person's residence.
     *
     * @see https://schema.org/homeLocation
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\ContactPoint')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/homeLocation'])]
    #[Assert\NotNull]
    private ContactPoint $homeLocation;

    /**
     * Of a \[\[Person\]\], and less typically of an \[\[Organization\]\], to indicate a topic that is known about - suggesting possible expertise but not implying it. We do not distinguish skill levels here, or relate this to educational content, events, objectives or \[\[JobPosting\]\] descriptions.
     *
     * @see https://schema.org/knowsAbout
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/knowsAbout'])]
    private ?string $knowsAbout = null;

    /**
     * The person's spouse.
     *
     * @see https://schema.org/spouse
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ApiProperty(types: ['https://schema.org/spouse'])]
    private ?Person $spouse = null;

    /**
     * The publishingPrinciples property indicates (typically via \[\[URL\]\]) a document describing the editorial principles of an \[\[Organization\]\] (or individual, e.g. a \[\[Person\]\] writing a blog) that relate to their activities as a publisher, e.g. ethics or diversity policies. When applied to a \[\[CreativeWork\]\] (e.g. \[\[NewsArticle\]\]) the principles are those of the party primarily responsible for the creation of the \[\[CreativeWork\]\]. While such policies are most typically expressed in natural language, sometimes related information (e.g. indicating a \[\[funder\]\]) can be expressed using schema.org terminology.
     *
     * @see https://schema.org/publishingPrinciples
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\URL')]
    #[ApiProperty(types: ['https://schema.org/publishingPrinciples'])]
    #[Assert\Url]
    private ?string $publishingPrinciples = null;

    /**
     * @var Collection<Text>|null the International Standard of Industrial Classification of All Economic Activities (ISIC), Revision 4 code for a particular organization, business person, or place
     *
     * @see https://schema.org/isicV4
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'person_text_isic_v4')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/isicV4'])]
    private ?Collection $isicV4 = null;

    /**
     * Physical address of the item.
     *
     * @see https://schema.org/address
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/address'])]
    private ?string $address = null;

    /**
     * An additional name for a Person, can be used for a middle name.
     *
     * @see https://schema.org/additionalName
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/additionalName'])]
    private ?string $additionalName = null;

    /**
     * A person or organization that supports (sponsors) something through some kind of financial contribution.
     *
     * @see https://schema.org/funder
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/funder'])]
    #[Assert\NotNull]
    private Organization $funder;

    /**
     * A person or organization that supports a thing through a pledge, promise, or financial contribution. E.g. a sponsor of a Medical Study or a corporate sponsor of an event.
     *
     * @see https://schema.org/sponsor
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/sponsor'])]
    #[Assert\NotNull]
    private Organization $sponsor;

    /**
     * The job title of the person (for example, Financial Manager).
     *
     * @see https://schema.org/jobTitle
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\DefinedTerm')]
    #[ApiProperty(types: ['https://schema.org/jobTitle'])]
    private ?DefinedTerm $jobTitle = null;

    /**
     * Certification information about a product, organization, service, place, or person.
     *
     * @see https://schema.org/hasCertification
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Certification')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/hasCertification'])]
    #[Assert\NotNull]
    private Certification $hasCertification;

    /**
     * The Value-added Tax ID of the organization or person.
     *
     * @see https://schema.org/vatID
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/vatID'])]
    private ?string $vatID = null;

    /**
     * The weight of the product or person.
     *
     * @see https://schema.org/weight
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ApiProperty(types: ['https://schema.org/weight'])]
    private ?QuantitativeValue $weight = null;

    /**
     * A contact point for a person or organization.
     *
     * @see https://schema.org/contactPoint
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\ContactPoint')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/contactPoint'])]
    #[Assert\NotNull]
    private ContactPoint $contactPoint;

    /**
     * An organization that this person is affiliated with. For example, a school/university, a club, or a team.
     *
     * @see https://schema.org/affiliation
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/affiliation'])]
    #[Assert\NotNull]
    private Organization $affiliation;

    /**
     * An Organization (or ProgramMembership) to which this Person or Organization belongs.
     *
     * @see https://schema.org/memberOf
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\ProgramMembership')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/memberOf'])]
    #[Assert\NotNull]
    private ProgramMembership $memberOf;

    /**
     * @var Collection<Place>|null points-of-Sales operated by the organization or person
     *
     * @see https://schema.org/hasPOS
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Place')]
    #[ORM\JoinTable(name: 'person_place_has_pos')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/hasPOS'])]
    private ?Collection $hasPOS = null;

    /**
     * The most generic bi-directional social/work relation.
     *
     * @see https://schema.org/knows
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ApiProperty(types: ['https://schema.org/knows'])]
    private ?Person $knows = null;

    /**
     * The telephone number.
     *
     * @see https://schema.org/telephone
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/telephone'])]
    private ?string $telephone = null;

    /**
     * Event that this person is a performer or participant in.
     *
     * @see https://schema.org/performerIn
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Event')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/performerIn'])]
    #[Assert\NotNull]
    private Event $performerIn;

    /**
     * Indicates an OfferCatalog listing for this Organization, Person, or Service.
     *
     * @see https://schema.org/hasOfferCatalog
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\OfferCatalog')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/hasOfferCatalog'])]
    #[Assert\NotNull]
    private OfferCatalog $hasOfferCatalog;

    /**
     * A parent of this person.
     *
     * @see https://schema.org/parent
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/parent'])]
    #[Assert\NotNull]
    private Person $parent;

    /**
     * @var Collection<Demand>|null a pointer to products or services sought by the organization or person (demand)
     *
     * @see https://schema.org/seeks
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Demand')]
    #[ORM\JoinTable(name: 'person_demand_seeks')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/seeks'])]
    private ?Collection $seeks = null;

    /**
     * Email address.
     *
     * @see https://schema.org/email
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/email'])]
    #[Assert\Email]
    private ?string $email = null;

    /**
     * Gender of something, typically a \[\[Person\]\], but possibly also fictional characters, animals, etc. While https://schema.org/Male and https://schema.org/Female may be used, text strings are also acceptable for people who do not identify as a binary gender. The \[\[gender\]\] property can also be used in an extended sense to cover e.g. the gender of sports teams. As with the gender of individuals, we do not try to enumerate all possibilities. A mixed-gender \[\[SportsTeam\]\] can be indicated with a text value of "Mixed".
     *
     * @see https://schema.org/gender
     */
    #[ORM\Column]
    #[ApiProperty(types: ['https://schema.org/gender'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [GenderType::class, 'toArray'])]
    private string $gender;

    /**
     * @var Collection<Person>|null the most generic uni-directional social relation
     *
     * @see https://schema.org/follows
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Person')]
    #[ORM\JoinTable(name: 'person_person_follows')]
    #[ORM\InverseJoinColumn(name: 'follow_person_id', unique: true)]
    #[ApiProperty(types: ['https://schema.org/follows'])]
    private ?Collection $follows = null;

    /**
     * The Dun &amp; Bradstreet DUNS number for identifying an organization or business person.
     *
     * @see https://schema.org/duns
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/duns'])]
    private ?string $duns = null;

    /**
     * Organizations that the person works for.
     *
     * @see https://schema.org/worksFor
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/worksFor'])]
    #[Assert\NotNull]
    private Organization $worksFor;

    /**
     * Given name. In the U.S., the first name of a Person.
     *
     * @see https://schema.org/givenName
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/givenName'])]
    private ?string $givenName = null;

    /**
     * A \[callsign\](https://en.wikipedia.org/wiki/Call\_sign), as used in broadcasting and radio communications to identify people, radio and TV stations, or vehicles.
     *
     * @see https://schema.org/callSign
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/callSign'])]
    private ?string $callSign = null;

    /**
     * The place where the person was born.
     *
     * @see https://schema.org/birthPlace
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Place')]
    #[ApiProperty(types: ['https://schema.org/birthPlace'])]
    private ?Place $birthPlace = null;

    /**
     * The most generic familial relation.
     *
     * @see https://schema.org/relatedTo
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ApiProperty(types: ['https://schema.org/relatedTo'])]
    private ?Person $relatedTo = null;

    /**
     * An award won by or for this item.
     *
     * @see https://schema.org/award
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/award'])]
    private ?string $award = null;

    /**
     * The fax number.
     *
     * @see https://schema.org/faxNumber
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/faxNumber'])]
    private ?string $faxNumber = null;

    /**
     * The Person's occupation. For past professions, use Role for expressing dates.
     *
     * @see https://schema.org/hasOccupation
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Occupation')]
    #[ApiProperty(types: ['https://schema.org/hasOccupation'])]
    private ?Occupation $hasOccupation = null;

    /**
     * The \[Global Location Number\](http://www.gs1.org/gln) (GLN, sometimes also referred to as International Location Number or ILN) of the respective organization, person, or place. The GLN is a 13-digit number used to identify parties and physical locations.
     *
     * @see https://schema.org/globalLocationNumber
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/globalLocationNumber'])]
    private ?string $globalLocationNumber = null;

    /**
     * Nationality of the person.
     *
     * @see https://schema.org/nationality
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Country')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/nationality'])]
    #[Assert\NotNull]
    private Country $nationality;

    /**
     * Family name. In the U.S., the last name of a Person.
     *
     * @see https://schema.org/familyName
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/familyName'])]
    private ?string $familyName = null;

    /**
     * A contact location for a person's place of work.
     *
     * @see https://schema.org/workLocation
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Place')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/workLocation'])]
    #[Assert\NotNull]
    private Place $workLocation;

    /**
     * @var Collection<Text>|null the North American Industry Classification System (NAICS) code for a particular organization or business person
     *
     * @see https://schema.org/naics
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'person_text_naics')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/naics'])]
    private ?Collection $naics = null;

    /**
     * The Tax / Fiscal ID of the organization or person, e.g. the TIN in the US or the CIF/NIF in Spain.
     *
     * @see https://schema.org/taxID
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/taxID'])]
    private ?string $taxID = null;

    /**
     * A credential awarded to the Person or Organization.
     *
     * @see https://schema.org/hasCredential
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\EducationalOccupationalCredential')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/hasCredential'])]
    #[Assert\NotNull]
    private EducationalOccupationalCredential $hasCredential;

    /**
     * Of a \[\[Person\]\], and less typically of an \[\[Organization\]\], to indicate a known language. We do not distinguish skill levels or reading/writing/speaking/signing here. Use language codes from the \[IETF BCP 47 standard\](http://tools.ietf.org/html/bcp47).
     *
     * @see https://schema.org/knowsLanguage
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Language')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/knowsLanguage'])]
    #[Assert\NotNull]
    private Language $knowsLanguage;

    /**
     * Date of death.
     *
     * @see https://schema.org/deathDate
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/deathDate'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $deathDate = null;

    /**
     * The place where the person died.
     *
     * @see https://schema.org/deathPlace
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Place')]
    #[ApiProperty(types: ['https://schema.org/deathPlace'])]
    private ?Place $deathPlace = null;

    /**
     * A colleague of the person.
     *
     * @see https://schema.org/colleague
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
    #[ApiProperty(types: ['https://schema.org/colleague'])]
    #[Assert\Url]
    private ?string $colleague = null;

    /**
     * @var Collection<Organization>|null the brand(s) associated with a product or service, or the brand(s) maintained by an organization or business person
     *
     * @see https://schema.org/brand
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Organization')]
    #[ORM\JoinTable(name: 'person_organization_brand')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/brand'])]
    private ?Collection $brand = null;

    /**
     * The number of completed interactions for this entity, in a particular role (the 'agent'), in a particular action (indicated in the statistic), and in a particular context (i.e. interactionService).
     *
     * @see https://schema.org/agentInteractionStatistic
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\InteractionCounter')]
    #[ApiProperty(types: ['https://schema.org/agentInteractionStatistic'])]
    private ?InteractionCounter $agentInteractionStatistic = null;

    /**
     * The total financial value of the person as calculated by subtracting assets from liabilities.
     *
     * @see https://schema.org/netWorth
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\PriceSpecification')]
    #[ApiProperty(types: ['https://schema.org/netWorth'])]
    private ?PriceSpecification $netWorth = null;

    /**
     * A sibling of the person.
     *
     * @see https://schema.org/sibling
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/sibling'])]
    #[Assert\NotNull]
    private Person $sibling;

    /**
     * A child of the person.
     *
     * @see https://schema.org/children
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/children'])]
    #[Assert\NotNull]
    private Person $children;

    /**
     * An honorific suffix following a Person's name such as M.D./PhD/MSCSW.
     *
     * @see https://schema.org/honorificSuffix
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/honorificSuffix'])]
    private ?string $honorificSuffix = null;

    /**
     * The height of the item.
     *
     * @see https://schema.org/height
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ApiProperty(types: ['https://schema.org/height'])]
    private ?QuantitativeValue $height = null;

    /**
     * The number of interactions for the CreativeWork using the WebSite or SoftwareApplication. The most specific child type of InteractionCounter should be used.
     *
     * @see https://schema.org/interactionStatistic
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\InteractionCounter')]
    #[ApiProperty(types: ['https://schema.org/interactionStatistic'])]
    private ?InteractionCounter $interactionStatistic = null;

    /**
     * An honorific prefix preceding a Person's name such as Dr/Mrs/Mr.
     *
     * @see https://schema.org/honorificPrefix
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/honorificPrefix'])]
    private ?string $honorificPrefix = null;

    /**
     * Date of birth.
     *
     * @see https://schema.org/birthDate
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/birthDate'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $birthDate = null;

    /**
     * @var Collection<OwnershipInfo>|null products owned by the organization or person
     *
     * @see https://schema.org/owns
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\OwnershipInfo')]
    #[ORM\JoinTable(name: 'person_ownership_info_owns')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/owns'])]
    private ?Collection $owns = null;

    /**
     * An organization that the person is an alumni of.
     *
     * @see https://schema.org/alumniOf
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/alumniOf'])]
    #[Assert\NotNull]
    private Organization $alumniOf;

    /**
     * @var Collection<Offer>|null a pointer to products or services offered by the organization or person
     *
     * @see https://schema.org/makesOffer
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Offer')]
    #[ORM\JoinTable(name: 'person_offer_makes_offer')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/makesOffer'])]
    private ?Collection $makesOffer = null;

    /**
     * A \[\[Grant\]\] that directly or indirectly provide funding or sponsorship for this item. See also \[\[ownershipFundingInfo\]\].
     *
     * @see https://schema.org/funding
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Grant')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/funding'])]
    #[Assert\NotNull]
    private Grant $funding;

    public function __construct()
    {
        $this->isicV4 = new ArrayCollection();
        $this->hasPOS = new ArrayCollection();
        $this->seeks = new ArrayCollection();
        $this->follows = new ArrayCollection();
        $this->naics = new ArrayCollection();
        $this->brand = new ArrayCollection();
        $this->owns = new ArrayCollection();
        $this->makesOffer = new ArrayCollection();
    }

    public function setHomeLocation(ContactPoint $homeLocation): void
    {
        $this->homeLocation = $homeLocation;
    }

    public function getHomeLocation(): ContactPoint
    {
        return $this->homeLocation;
    }

    public function setKnowsAbout(?string $knowsAbout): void
    {
        $this->knowsAbout = $knowsAbout;
    }

    public function getKnowsAbout(): ?string
    {
        return $this->knowsAbout;
    }

    public function setSpouse(?Person $spouse): void
    {
        $this->spouse = $spouse;
    }

    public function getSpouse(): ?Person
    {
        return $this->spouse;
    }

    public function setPublishingPrinciples(?string $publishingPrinciples): void
    {
        $this->publishingPrinciples = $publishingPrinciples;
    }

    public function getPublishingPrinciples(): ?string
    {
        return $this->publishingPrinciples;
    }

    public function addIsicV4(string $isicV4): void
    {
        $this->isicV4[] = $isicV4;
    }

    public function removeIsicV4(string $isicV4): void
    {
        $this->isicV4->removeElement($isicV4);
    }

    /**
     * @return Collection<Text>|null
     */
    public function getIsicV4(): Collection
    {
        return $this->isicV4;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAdditionalName(?string $additionalName): void
    {
        $this->additionalName = $additionalName;
    }

    public function getAdditionalName(): ?string
    {
        return $this->additionalName;
    }

    public function setFunder(Organization $funder): void
    {
        $this->funder = $funder;
    }

    public function getFunder(): Organization
    {
        return $this->funder;
    }

    public function setSponsor(Organization $sponsor): void
    {
        $this->sponsor = $sponsor;
    }

    public function getSponsor(): Organization
    {
        return $this->sponsor;
    }

    public function setJobTitle(?DefinedTerm $jobTitle): void
    {
        $this->jobTitle = $jobTitle;
    }

    public function getJobTitle(): ?DefinedTerm
    {
        return $this->jobTitle;
    }

    public function setHasCertification(Certification $hasCertification): void
    {
        $this->hasCertification = $hasCertification;
    }

    public function getHasCertification(): Certification
    {
        return $this->hasCertification;
    }

    public function setVatID(?string $vatID): void
    {
        $this->vatID = $vatID;
    }

    public function getVatID(): ?string
    {
        return $this->vatID;
    }

    public function setWeight(?QuantitativeValue $weight): void
    {
        $this->weight = $weight;
    }

    public function getWeight(): ?QuantitativeValue
    {
        return $this->weight;
    }

    public function setContactPoint(ContactPoint $contactPoint): void
    {
        $this->contactPoint = $contactPoint;
    }

    public function getContactPoint(): ContactPoint
    {
        return $this->contactPoint;
    }

    public function setAffiliation(Organization $affiliation): void
    {
        $this->affiliation = $affiliation;
    }

    public function getAffiliation(): Organization
    {
        return $this->affiliation;
    }

    public function setMemberOf(ProgramMembership $memberOf): void
    {
        $this->memberOf = $memberOf;
    }

    public function getMemberOf(): ProgramMembership
    {
        return $this->memberOf;
    }

    public function addHasPO(Place $hasPO): void
    {
        $this->hasPOS[] = $hasPO;
    }

    public function removeHasPO(Place $hasPO): void
    {
        $this->hasPOS->removeElement($hasPO);
    }

    /**
     * @return Collection<Place>|null
     */
    public function getHasPOS(): Collection
    {
        return $this->hasPOS;
    }

    public function setKnows(?Person $knows): void
    {
        $this->knows = $knows;
    }

    public function getKnows(): ?Person
    {
        return $this->knows;
    }

    public function setTelephone(?string $telephone): void
    {
        $this->telephone = $telephone;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setPerformerIn(Event $performerIn): void
    {
        $this->performerIn = $performerIn;
    }

    public function getPerformerIn(): Event
    {
        return $this->performerIn;
    }

    public function setHasOfferCatalog(OfferCatalog $hasOfferCatalog): void
    {
        $this->hasOfferCatalog = $hasOfferCatalog;
    }

    public function getHasOfferCatalog(): OfferCatalog
    {
        return $this->hasOfferCatalog;
    }

    public function setParent(Person $parent): void
    {
        $this->parent = $parent;
    }

    public function getParent(): Person
    {
        return $this->parent;
    }

    public function addSeek(Demand $seek): void
    {
        $this->seeks[] = $seek;
    }

    public function removeSeek(Demand $seek): void
    {
        $this->seeks->removeElement($seek);
    }

    /**
     * @return Collection<Demand>|null
     */
    public function getSeeks(): Collection
    {
        return $this->seeks;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function addFollow(Person $follow): void
    {
        $this->follows[] = $follow;
    }

    public function removeFollow(Person $follow): void
    {
        $this->follows->removeElement($follow);
    }

    /**
     * @return Collection<Person>|null
     */
    public function getFollows(): Collection
    {
        return $this->follows;
    }

    public function setDuns(?string $duns): void
    {
        $this->duns = $duns;
    }

    public function getDuns(): ?string
    {
        return $this->duns;
    }

    public function setWorksFor(Organization $worksFor): void
    {
        $this->worksFor = $worksFor;
    }

    public function getWorksFor(): Organization
    {
        return $this->worksFor;
    }

    public function setGivenName(?string $givenName): void
    {
        $this->givenName = $givenName;
    }

    public function getGivenName(): ?string
    {
        return $this->givenName;
    }

    public function setCallSign(?string $callSign): void
    {
        $this->callSign = $callSign;
    }

    public function getCallSign(): ?string
    {
        return $this->callSign;
    }

    public function setBirthPlace(?Place $birthPlace): void
    {
        $this->birthPlace = $birthPlace;
    }

    public function getBirthPlace(): ?Place
    {
        return $this->birthPlace;
    }

    public function setRelatedTo(?Person $relatedTo): void
    {
        $this->relatedTo = $relatedTo;
    }

    public function getRelatedTo(): ?Person
    {
        return $this->relatedTo;
    }

    public function setAward(?string $award): void
    {
        $this->award = $award;
    }

    public function getAward(): ?string
    {
        return $this->award;
    }

    public function setFaxNumber(?string $faxNumber): void
    {
        $this->faxNumber = $faxNumber;
    }

    public function getFaxNumber(): ?string
    {
        return $this->faxNumber;
    }

    public function setHasOccupation(?Occupation $hasOccupation): void
    {
        $this->hasOccupation = $hasOccupation;
    }

    public function getHasOccupation(): ?Occupation
    {
        return $this->hasOccupation;
    }

    public function setGlobalLocationNumber(?string $globalLocationNumber): void
    {
        $this->globalLocationNumber = $globalLocationNumber;
    }

    public function getGlobalLocationNumber(): ?string
    {
        return $this->globalLocationNumber;
    }

    public function setNationality(Country $nationality): void
    {
        $this->nationality = $nationality;
    }

    public function getNationality(): Country
    {
        return $this->nationality;
    }

    public function setFamilyName(?string $familyName): void
    {
        $this->familyName = $familyName;
    }

    public function getFamilyName(): ?string
    {
        return $this->familyName;
    }

    public function setWorkLocation(Place $workLocation): void
    {
        $this->workLocation = $workLocation;
    }

    public function getWorkLocation(): Place
    {
        return $this->workLocation;
    }

    public function addNaic(string $naic): void
    {
        $this->naics[] = $naic;
    }

    public function removeNaic(string $naic): void
    {
        $this->naics->removeElement($naic);
    }

    /**
     * @return Collection<Text>|null
     */
    public function getNaics(): Collection
    {
        return $this->naics;
    }

    public function setTaxID(?string $taxID): void
    {
        $this->taxID = $taxID;
    }

    public function getTaxID(): ?string
    {
        return $this->taxID;
    }

    public function setHasCredential(EducationalOccupationalCredential $hasCredential): void
    {
        $this->hasCredential = $hasCredential;
    }

    public function getHasCredential(): EducationalOccupationalCredential
    {
        return $this->hasCredential;
    }

    public function setKnowsLanguage(Language $knowsLanguage): void
    {
        $this->knowsLanguage = $knowsLanguage;
    }

    public function getKnowsLanguage(): Language
    {
        return $this->knowsLanguage;
    }

    public function setDeathDate(?\DateTimeInterface $deathDate): void
    {
        $this->deathDate = $deathDate;
    }

    public function getDeathDate(): ?\DateTimeInterface
    {
        return $this->deathDate;
    }

    public function setDeathPlace(?Place $deathPlace): void
    {
        $this->deathPlace = $deathPlace;
    }

    public function getDeathPlace(): ?Place
    {
        return $this->deathPlace;
    }

    public function setColleague(?string $colleague): void
    {
        $this->colleague = $colleague;
    }

    public function getColleague(): ?string
    {
        return $this->colleague;
    }

    public function addBrand(Organization $brand): void
    {
        $this->brand[] = $brand;
    }

    public function removeBrand(Organization $brand): void
    {
        $this->brand->removeElement($brand);
    }

    /**
     * @return Collection<Organization>|null
     */
    public function getBrand(): Collection
    {
        return $this->brand;
    }

    public function setAgentInteractionStatistic(?InteractionCounter $agentInteractionStatistic): void
    {
        $this->agentInteractionStatistic = $agentInteractionStatistic;
    }

    public function getAgentInteractionStatistic(): ?InteractionCounter
    {
        return $this->agentInteractionStatistic;
    }

    public function setNetWorth(?PriceSpecification $netWorth): void
    {
        $this->netWorth = $netWorth;
    }

    public function getNetWorth(): ?PriceSpecification
    {
        return $this->netWorth;
    }

    public function setSibling(Person $sibling): void
    {
        $this->sibling = $sibling;
    }

    public function getSibling(): Person
    {
        return $this->sibling;
    }

    public function setChildren(Person $children): void
    {
        $this->children = $children;
    }

    public function getChildren(): Person
    {
        return $this->children;
    }

    public function setHonorificSuffix(?string $honorificSuffix): void
    {
        $this->honorificSuffix = $honorificSuffix;
    }

    public function getHonorificSuffix(): ?string
    {
        return $this->honorificSuffix;
    }

    public function setHeight(?QuantitativeValue $height): void
    {
        $this->height = $height;
    }

    public function getHeight(): ?QuantitativeValue
    {
        return $this->height;
    }

    public function setInteractionStatistic(?InteractionCounter $interactionStatistic): void
    {
        $this->interactionStatistic = $interactionStatistic;
    }

    public function getInteractionStatistic(): ?InteractionCounter
    {
        return $this->interactionStatistic;
    }

    public function setHonorificPrefix(?string $honorificPrefix): void
    {
        $this->honorificPrefix = $honorificPrefix;
    }

    public function getHonorificPrefix(): ?string
    {
        return $this->honorificPrefix;
    }

    public function setBirthDate(?\DateTimeInterface $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function addOwn(OwnershipInfo $own): void
    {
        $this->owns[] = $own;
    }

    public function removeOwn(OwnershipInfo $own): void
    {
        $this->owns->removeElement($own);
    }

    /**
     * @return Collection<OwnershipInfo>|null
     */
    public function getOwns(): Collection
    {
        return $this->owns;
    }

    public function setAlumniOf(Organization $alumniOf): void
    {
        $this->alumniOf = $alumniOf;
    }

    public function getAlumniOf(): Organization
    {
        return $this->alumniOf;
    }

    public function addMakesOffer(Offer $makesOffer): void
    {
        $this->makesOffer[] = $makesOffer;
    }

    public function removeMakesOffer(Offer $makesOffer): void
    {
        $this->makesOffer->removeElement($makesOffer);
    }

    /**
     * @return Collection<Offer>|null
     */
    public function getMakesOffer(): Collection
    {
        return $this->makesOffer;
    }

    public function setFunding(Grant $funding): void
    {
        $this->funding = $funding;
    }

    public function getFunding(): Grant
    {
        return $this->funding;
    }
}
