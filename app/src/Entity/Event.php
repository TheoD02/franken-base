<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use App\Enum\EventAttendanceModeEnumeration;
use App\Enum\EventStatusType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An event happening at a certain time and location, such as a concert, lecture, or festival. Ticketing information may be added via the \[\[offers\]\] property. Repeated events may be structured as separate Event objects.
 *
 * @see https://schema.org/Event
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
    'event' => Event::class,
    'danceEvent' => DanceEvent::class,
    'saleEvent' => SaleEvent::class,
    'eventSeries' => EventSeries::class,
    'hackathon' => Hackathon::class,
    'literaryEvent' => LiteraryEvent::class,
    'musicEvent' => MusicEvent::class,
    'theaterEvent' => TheaterEvent::class,
    'socialEvent' => SocialEvent::class,
    'childrensEvent' => ChildrensEvent::class,
    'comedyEvent' => ComedyEvent::class,
    'visualArtsEvent' => VisualArtsEvent::class,
    'festival' => Festival::class,
    'businessEvent' => BusinessEvent::class,
    'exhibitionEvent' => ExhibitionEvent::class,
    'foodEvent' => FoodEvent::class,
    'sportsEvent' => SportsEvent::class,
    'screeningEvent' => ScreeningEvent::class,
    'educationEvent' => EducationEvent::class,
    'deliveryEvent' => DeliveryEvent::class,
    'courseInstance' => CourseInstance::class,
    'publicationEvent' => PublicationEvent::class,
    'userDownloads' => UserDownloads::class,
    'userLikes' => UserLikes::class,
    'userPlays' => UserPlays::class,
    'userTweets' => UserTweets::class,
    'userBlocks' => UserBlocks::class,
    'userPlusOnes' => UserPlusOnes::class,
    'userCheckins' => UserCheckins::class,
    'userPageVisits' => UserPageVisits::class,
    'userComments' => UserComments::class,
    'onDemandEvent' => OnDemandEvent::class,
    'broadcastEvent' => BroadcastEvent::class,
])]
class Event extends Thing
{
    /**
     * The location of, for example, where an event is happening, where an organization is located, or where an action takes place.
     *
     * @see https://schema.org/location
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\PostalAddress')]
    #[ApiProperty(types: ['https://schema.org/location'])]
    private ?PostalAddress $location = null;

    /**
     * An actor, e.g. in TV, radio, movie, video games etc., or in an event. Actors can be associated with individual items or with a series, episode, clip.
     *
     * @see https://schema.org/actor
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/actor'])]
    #[Assert\NotNull]
    private Person $actor;

    /**
     * The time admission will commence.
     *
     * @see https://schema.org/doorTime
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Time')]
    #[ApiProperty(types: ['https://schema.org/doorTime'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $doorTime = null;

    /**
     * The language of the content or performance or used in an action. Please use one of the language codes from the \[IETF BCP 47 standard\](http://tools.ietf.org/html/bcp47). See also \[\[availableLanguage\]\].
     *
     * @see https://schema.org/inLanguage
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/inLanguage'])]
    private ?string $inLanguage = null;

    /**
     * Organization or person who adapts a creative work to different languages, regional differences and technical requirements of a target market, or that translates during some event.
     *
     * @see https://schema.org/translator
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/translator'])]
    #[Assert\NotNull]
    private Person $translator;

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
     * A person or organization attending the event.
     *
     * @see https://schema.org/attendee
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/attendee'])]
    #[Assert\NotNull]
    private Person $attendee;

    /**
     * The start date and time of the item (in \[ISO 8601 date format\](http://en.wikipedia.org/wiki/ISO\_8601)).
     *
     * @see https://schema.org/startDate
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/startDate'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $startDate = null;

    /**
     * Used in conjunction with eventStatus for rescheduled or cancelled events. This property contains the previously scheduled start date. For rescheduled events, the startDate property should be used for the newly scheduled start date. In the (rare) case of an event that has been postponed and rescheduled multiple times, this field may be repeated.
     *
     * @see https://schema.org/previousStartDate
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/previousStartDate'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $previousStartDate = null;

    /**
     * The maximum physical attendee capacity of an \[\[Event\]\] whose \[\[eventAttendanceMode\]\] is \[\[OfflineEventAttendanceMode\]\] (or the offline aspects, in the case of a \[\[MixedEventAttendanceMode\]\]).
     *
     * @see https://schema.org/maximumPhysicalAttendeeCapacity
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
    #[ApiProperty(types: ['https://schema.org/maximumPhysicalAttendeeCapacity'])]
    private ?int $maximumPhysicalAttendeeCapacity = null;

    /**
     * Associates an \[\[Event\]\] with a \[\[Schedule\]\]. There are circumstances where it is preferable to share a schedule for a series of repeating events rather than data on the individual events themselves. For example, a website or application might prefer to publish a schedule for a weekly gym class rather than provide data on every event. A schedule could be processed by applications to add forthcoming events to a calendar. An \[\[Event\]\] that is associated with a \[\[Schedule\]\] using this property should not have \[\[startDate\]\] or \[\[endDate\]\] properties. These are instead defined within the associated \[\[Schedule\]\], this avoids any ambiguity for clients using the data. The property might have repeated values to specify different schedules, e.g. for different months or seasons.
     *
     * @see https://schema.org/eventSchedule
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Schedule')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/eventSchedule'])]
    #[Assert\NotNull]
    private Schedule $eventSchedule;

    /**
     * The end date and time of the item (in \[ISO 8601 date format\](http://en.wikipedia.org/wiki/ISO\_8601)).
     *
     * @see https://schema.org/endDate
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/endDate'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $endDate = null;

    /**
     * A work performed in some event, for example a play performed in a TheaterEvent.
     *
     * @see https://schema.org/workPerformed
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWork')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/workPerformed'])]
    #[Assert\NotNull]
    private CreativeWork $workPerformed;

    /**
     * A work featured in some event, e.g. exhibited in an ExhibitionEvent. Specific subproperties are available for workPerformed (e.g. a play), or a workPresented (a Movie at a ScreeningEvent).
     *
     * @see https://schema.org/workFeatured
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWork')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/workFeatured'])]
    #[Assert\NotNull]
    private CreativeWork $workFeatured;

    /**
     * The eventAttendanceMode of an event indicates whether it occurs online, offline, or a mix.
     *
     * @see https://schema.org/eventAttendanceMode
     */
    #[ORM\Column(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/eventAttendanceMode'])]
    #[Assert\Choice(callback: [EventAttendanceModeEnumeration::class, 'toArray'])]
    private ?string $eventAttendanceMode = null;

    /**
     * An eventStatus of an event represents its status; particularly useful when an event is cancelled or rescheduled.
     *
     * @see https://schema.org/eventStatus
     */
    #[ORM\Column]
    #[ApiProperty(types: ['https://schema.org/eventStatus'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [EventStatusType::class, 'toArray'])]
    private string $eventStatus;

    /**
     * A director of e.g. TV, radio, movie, video gaming etc. content, or of an event. Directors can be associated with individual items or with a series, episode, clip.
     *
     * @see https://schema.org/director
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/director'])]
    #[Assert\NotNull]
    private Person $director;

    /**
     * The overall rating, based on a collection of reviews or ratings, of the item.
     *
     * @see https://schema.org/aggregateRating
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\AggregateRating')]
    #[ApiProperty(types: ['https://schema.org/aggregateRating'])]
    private ?AggregateRating $aggregateRating = null;

    /**
     * The maximum virtual attendee capacity of an \[\[Event\]\] whose \[\[eventAttendanceMode\]\] is \[\[OnlineEventAttendanceMode\]\] (or the online aspects, in the case of a \[\[MixedEventAttendanceMode\]\]).
     *
     * @see https://schema.org/maximumVirtualAttendeeCapacity
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
    #[ApiProperty(types: ['https://schema.org/maximumVirtualAttendeeCapacity'])]
    private ?int $maximumVirtualAttendeeCapacity = null;

    /**
     * A secondary contributor to the CreativeWork or Event.
     *
     * @see https://schema.org/contributor
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/contributor'])]
    #[Assert\NotNull]
    private Organization $contributor;

    /**
     * Keywords or tags used to describe some item. Multiple textual entries in a keywords list are typically delimited by commas, or by repeating the property.
     *
     * @see https://schema.org/keywords
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/keywords'])]
    private ?string $keywords = null;

    /**
     * The typical expected age range, e.g. '7-9', '11-'.
     *
     * @see https://schema.org/typicalAgeRange
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/typicalAgeRange'])]
    private ?string $typicalAgeRange = null;

    /**
     * The total number of individuals that may attend an event or venue.
     *
     * @see https://schema.org/maximumAttendeeCapacity
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
    #[ApiProperty(types: ['https://schema.org/maximumAttendeeCapacity'])]
    private ?int $maximumAttendeeCapacity = null;

    /**
     * The person or organization who wrote a composition, or who is the composer of a work performed at some event.
     *
     * @see https://schema.org/composer
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ApiProperty(types: ['https://schema.org/composer'])]
    private ?Person $composer = null;

    /**
     * The duration of the item (movie, audio recording, event, etc.) in \[ISO 8601 date format\](http://en.wikipedia.org/wiki/ISO\_8601).
     *
     * @see https://schema.org/duration
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Duration')]
    #[ApiProperty(types: ['https://schema.org/duration'])]
    private ?Duration $duration = null;

    /**
     * An organizer of an Event.
     *
     * @see https://schema.org/organizer
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/organizer'])]
    #[Assert\NotNull]
    private Organization $organizer;

    /**
     * A review of the item.
     *
     * @see https://schema.org/review
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Review')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/review'])]
    #[Assert\NotNull]
    private Review $review;

    /**
     * A flag to signal that the item, event, or place is accessible for free.
     *
     * @see https://schema.org/isAccessibleForFree
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Boolean')]
    #[ApiProperty(types: ['https://schema.org/isAccessibleForFree'])]
    private ?bool $isAccessibleForFree = null;

    /**
     * An intended audience, i.e. a group for whom something was created.
     *
     * @see https://schema.org/audience
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Audience')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/audience'])]
    #[Assert\NotNull]
    private Audience $audience;

    /**
     * The number of attendee places for an event that remain unallocated.
     *
     * @see https://schema.org/remainingAttendeeCapacity
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
    #[ApiProperty(types: ['https://schema.org/remainingAttendeeCapacity'])]
    private ?int $remainingAttendeeCapacity = null;

    /**
     * An Event that is part of this event. For example, a conference event includes many presentations, each of which is a subEvent of the conference.
     *
     * @see https://schema.org/subEvent
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Event')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/subEvent'])]
    #[Assert\NotNull]
    private Event $subEvent;

    /**
     * A performer at the event—for example, a presenter, musician, musical group or actor.
     *
     * @see https://schema.org/performer
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/performer'])]
    #[Assert\NotNull]
    private Person $performer;

    /**
     * The subject matter of the content.
     *
     * @see https://schema.org/about
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Thing')]
    #[ApiProperty(types: ['https://schema.org/about'])]
    private ?Thing $about = null;

    /**
     * @var Collection<Demand>|null An offer to provide this item—for example, an offer to sell a product, rent the DVD of a movie, perform a service, or give away tickets to an event. Use \[\[businessFunction\]\] to indicate the kind of transaction offered, i.e. sell, lease, etc. This property can also be used to describe a \[\[Demand\]\]. While this property is listed as expected on a number of common types, it can be used in others. In that case, using a second type, such as Product or a subtype of Product, can clarify the nature of the offer.
     *
     * @see https://schema.org/offers
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Demand')]
    #[ORM\JoinTable(name: 'event_demand_offers')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/offers'])]
    private ?Collection $offers = null;

    /**
     * An event that this event is a part of. For example, a collection of individual music performances might each have a music festival as their superEvent.
     *
     * @see https://schema.org/superEvent
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Event')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/superEvent'])]
    #[Assert\NotNull]
    private Event $superEvent;

    /**
     * The CreativeWork that captured all or part of this Event.
     *
     * @see https://schema.org/recordedIn
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWork')]
    #[ApiProperty(types: ['https://schema.org/recordedIn'])]
    private ?CreativeWork $recordedIn = null;

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
        $this->offers = new ArrayCollection();
    }

    public function setLocation(?PostalAddress $location): void
    {
        $this->location = $location;
    }

    public function getLocation(): ?PostalAddress
    {
        return $this->location;
    }

    public function setActor(Person $actor): void
    {
        $this->actor = $actor;
    }

    public function getActor(): Person
    {
        return $this->actor;
    }

    public function setDoorTime(?\DateTimeInterface $doorTime): void
    {
        $this->doorTime = $doorTime;
    }

    public function getDoorTime(): ?\DateTimeInterface
    {
        return $this->doorTime;
    }

    public function setInLanguage(?string $inLanguage): void
    {
        $this->inLanguage = $inLanguage;
    }

    public function getInLanguage(): ?string
    {
        return $this->inLanguage;
    }

    public function setTranslator(Person $translator): void
    {
        $this->translator = $translator;
    }

    public function getTranslator(): Person
    {
        return $this->translator;
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

    public function setAttendee(Person $attendee): void
    {
        $this->attendee = $attendee;
    }

    public function getAttendee(): Person
    {
        return $this->attendee;
    }

    public function setStartDate(?\DateTimeInterface $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setPreviousStartDate(?\DateTimeInterface $previousStartDate): void
    {
        $this->previousStartDate = $previousStartDate;
    }

    public function getPreviousStartDate(): ?\DateTimeInterface
    {
        return $this->previousStartDate;
    }

    public function setMaximumPhysicalAttendeeCapacity(?int $maximumPhysicalAttendeeCapacity): void
    {
        $this->maximumPhysicalAttendeeCapacity = $maximumPhysicalAttendeeCapacity;
    }

    public function getMaximumPhysicalAttendeeCapacity(): ?int
    {
        return $this->maximumPhysicalAttendeeCapacity;
    }

    public function setEventSchedule(Schedule $eventSchedule): void
    {
        $this->eventSchedule = $eventSchedule;
    }

    public function getEventSchedule(): Schedule
    {
        return $this->eventSchedule;
    }

    public function setEndDate(?\DateTimeInterface $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setWorkPerformed(CreativeWork $workPerformed): void
    {
        $this->workPerformed = $workPerformed;
    }

    public function getWorkPerformed(): CreativeWork
    {
        return $this->workPerformed;
    }

    public function setWorkFeatured(CreativeWork $workFeatured): void
    {
        $this->workFeatured = $workFeatured;
    }

    public function getWorkFeatured(): CreativeWork
    {
        return $this->workFeatured;
    }

    public function setEventAttendanceMode(?string $eventAttendanceMode): void
    {
        $this->eventAttendanceMode = $eventAttendanceMode;
    }

    public function getEventAttendanceMode(): ?string
    {
        return $this->eventAttendanceMode;
    }

    public function setEventStatus(string $eventStatus): void
    {
        $this->eventStatus = $eventStatus;
    }

    public function getEventStatus(): string
    {
        return $this->eventStatus;
    }

    public function setDirector(Person $director): void
    {
        $this->director = $director;
    }

    public function getDirector(): Person
    {
        return $this->director;
    }

    public function setAggregateRating(?AggregateRating $aggregateRating): void
    {
        $this->aggregateRating = $aggregateRating;
    }

    public function getAggregateRating(): ?AggregateRating
    {
        return $this->aggregateRating;
    }

    public function setMaximumVirtualAttendeeCapacity(?int $maximumVirtualAttendeeCapacity): void
    {
        $this->maximumVirtualAttendeeCapacity = $maximumVirtualAttendeeCapacity;
    }

    public function getMaximumVirtualAttendeeCapacity(): ?int
    {
        return $this->maximumVirtualAttendeeCapacity;
    }

    public function setContributor(Organization $contributor): void
    {
        $this->contributor = $contributor;
    }

    public function getContributor(): Organization
    {
        return $this->contributor;
    }

    public function setKeywords(?string $keywords): void
    {
        $this->keywords = $keywords;
    }

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function setTypicalAgeRange(?string $typicalAgeRange): void
    {
        $this->typicalAgeRange = $typicalAgeRange;
    }

    public function getTypicalAgeRange(): ?string
    {
        return $this->typicalAgeRange;
    }

    public function setMaximumAttendeeCapacity(?int $maximumAttendeeCapacity): void
    {
        $this->maximumAttendeeCapacity = $maximumAttendeeCapacity;
    }

    public function getMaximumAttendeeCapacity(): ?int
    {
        return $this->maximumAttendeeCapacity;
    }

    public function setComposer(?Person $composer): void
    {
        $this->composer = $composer;
    }

    public function getComposer(): ?Person
    {
        return $this->composer;
    }

    public function setDuration(?Duration $duration): void
    {
        $this->duration = $duration;
    }

    public function getDuration(): ?Duration
    {
        return $this->duration;
    }

    public function setOrganizer(Organization $organizer): void
    {
        $this->organizer = $organizer;
    }

    public function getOrganizer(): Organization
    {
        return $this->organizer;
    }

    public function setReview(Review $review): void
    {
        $this->review = $review;
    }

    public function getReview(): Review
    {
        return $this->review;
    }

    public function setIsAccessibleForFree(?bool $isAccessibleForFree): void
    {
        $this->isAccessibleForFree = $isAccessibleForFree;
    }

    public function getIsAccessibleForFree(): ?bool
    {
        return $this->isAccessibleForFree;
    }

    public function setAudience(Audience $audience): void
    {
        $this->audience = $audience;
    }

    public function getAudience(): Audience
    {
        return $this->audience;
    }

    public function setRemainingAttendeeCapacity(?int $remainingAttendeeCapacity): void
    {
        $this->remainingAttendeeCapacity = $remainingAttendeeCapacity;
    }

    public function getRemainingAttendeeCapacity(): ?int
    {
        return $this->remainingAttendeeCapacity;
    }

    public function setSubEvent(Event $subEvent): void
    {
        $this->subEvent = $subEvent;
    }

    public function getSubEvent(): Event
    {
        return $this->subEvent;
    }

    public function setPerformer(Person $performer): void
    {
        $this->performer = $performer;
    }

    public function getPerformer(): Person
    {
        return $this->performer;
    }

    public function setAbout(?Thing $about): void
    {
        $this->about = $about;
    }

    public function getAbout(): ?Thing
    {
        return $this->about;
    }

    public function addOffer(Demand $offer): void
    {
        $this->offers[] = $offer;
    }

    public function removeOffer(Demand $offer): void
    {
        $this->offers->removeElement($offer);
    }

    /**
     * @return Collection<Demand>|null
     */
    public function getOffers(): Collection
    {
        return $this->offers;
    }

    public function setSuperEvent(Event $superEvent): void
    {
        $this->superEvent = $superEvent;
    }

    public function getSuperEvent(): Event
    {
        return $this->superEvent;
    }

    public function setRecordedIn(?CreativeWork $recordedIn): void
    {
        $this->recordedIn = $recordedIn;
    }

    public function getRecordedIn(): ?CreativeWork
    {
        return $this->recordedIn;
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
