<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A schedule defines a repeating time period used to describe a regularly occurring \[\[Event\]\]. At a minimum a schedule will specify \[\[repeatFrequency\]\] which describes the interval between occurrences of the event. Additional information can be provided to specify the schedule more precisely. This includes identifying the day(s) of the week or month when the recurring event will take place, in addition to its start and end time. Schedules may also have start and end dates to indicate when they are active, e.g. to define a limited calendar of events.
 *
 * @see https://schema.org/Schedule
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Schedule'])]
class Schedule extends Intangible
{
    /**
     * The endTime of something. For a reserved event or service (e.g. FoodEstablishmentReservation), the time that it is expected to end. For actions that span a period of time, when the action was performed. E.g. John wrote a book from January to \*December\*. For media, including audio and video, it's the time offset of the end of a clip within a larger file.\\n\\nNote that Event uses startDate/endDate instead of startTime/endTime, even when describing dates with times. This situation may be clarified in future revisions.
     *
     * @see https://schema.org/endTime
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Time')]
    #[ApiProperty(types: ['https://schema.org/endTime'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $endTime = null;

    /**
     * The startTime of something. For a reserved event or service (e.g. FoodEstablishmentReservation), the time that it is expected to start. For actions that span a period of time, when the action was performed. E.g. John wrote a book from \*January\* to December. For media, including audio and video, it's the time offset of the start of a clip within a larger file.\\n\\nNote that Event uses startDate/endDate instead of startTime/endTime, even when describing dates with times. This situation may be clarified in future revisions.
     *
     * @see https://schema.org/startTime
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Time')]
    #[ApiProperty(types: ['https://schema.org/startTime'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $startTime = null;

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
     * The end date and time of the item (in \[ISO 8601 date format\](http://en.wikipedia.org/wiki/ISO\_8601)).
     *
     * @see https://schema.org/endDate
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/endDate'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $endDate = null;

    /**
     * @var Collection<Text>|null Indicates the timezone for which the time(s) indicated in the \[\[Schedule\]\] are given. The value provided should be among those listed in the IANA Time Zone Database.
     *
     * @see https://schema.org/scheduleTimezone
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'schedule_text_schedule_timezone')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/scheduleTimezone'])]
    private ?Collection $scheduleTimezone = null;

    /**
     * @var Collection<Text>|null Defines the day(s) of the week on which a recurring \[\[Event\]\] takes place. May be specified using either \[\[DayOfWeek\]\], or alternatively \[\[Text\]\] conforming to iCal's syntax for byDay recurrence rules.
     *
     * @see https://schema.org/byDay
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'schedule_text_by_day')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/byDay'])]
    private ?Collection $byDay = null;

    /**
     * Defines a \[\[Date\]\] or \[\[DateTime\]\] during which a scheduled \[\[Event\]\] will not take place. The property allows exceptions to a \[\[Schedule\]\] to be specified. If an exception is specified as a \[\[DateTime\]\] then only the event that would have started at that specific date and time should be excluded from the schedule. If an exception is specified as a \[\[Date\]\] then any event that is scheduled for that 24 hour period should be excluded from the schedule. This allows a whole day to be excluded from the schedule without having to itemise every scheduled event.
     *
     * @see https://schema.org/exceptDate
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/exceptDate'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $exceptDate = null;

    /**
     * Defines the frequency at which \[\[Event\]\]s will occur according to a schedule \[\[Schedule\]\]. The intervals between events should be defined as a \[\[Duration\]\] of time.
     *
     * @see https://schema.org/repeatFrequency
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Duration')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/repeatFrequency'])]
    #[Assert\NotNull]
    private Duration $repeatFrequency;

    /**
     * Defines the number of times a recurring \[\[Event\]\] will take place.
     *
     * @see https://schema.org/repeatCount
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Integer')]
    #[ApiProperty(types: ['https://schema.org/repeatCount'])]
    private ?int $repeatCount = null;

    /**
     * The duration of the item (movie, audio recording, event, etc.) in \[ISO 8601 date format\](http://en.wikipedia.org/wiki/ISO\_8601).
     *
     * @see https://schema.org/duration
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Duration')]
    #[ApiProperty(types: ['https://schema.org/duration'])]
    private ?Duration $duration = null;

    /**
     * @var Collection<int>|null Defines the week(s) of the month on which a recurring Event takes place. Specified as an Integer between 1-5. For clarity, byMonthWeek is best used in conjunction with byDay to indicate concepts like the first and third Mondays of a month.
     *
     * @see https://schema.org/byMonthWeek
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Integer')]
    #[ORM\JoinTable(name: 'schedule_integer_by_month_week')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/byMonthWeek'])]
    private ?Collection $byMonthWeek = null;

    /**
     * @var Collection<int>|null Defines the day(s) of the month on which a recurring \[\[Event\]\] takes place. Specified as an \[\[Integer\]\] between 1-31.
     *
     * @see https://schema.org/byMonthDay
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Integer')]
    #[ORM\JoinTable(name: 'schedule_integer_by_month_day')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/byMonthDay'])]
    private ?Collection $byMonthDay = null;

    /**
     * @var Collection<int>|null Defines the month(s) of the year on which a recurring \[\[Event\]\] takes place. Specified as an \[\[Integer\]\] between 1-12. January is 1.
     *
     * @see https://schema.org/byMonth
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Integer')]
    #[ORM\JoinTable(name: 'schedule_integer_by_month')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/byMonth'])]
    private ?Collection $byMonth = null;

    public function __construct()
    {
        $this->scheduleTimezone = new ArrayCollection();
        $this->byDay = new ArrayCollection();
        $this->byMonthWeek = new ArrayCollection();
        $this->byMonthDay = new ArrayCollection();
        $this->byMonth = new ArrayCollection();
    }

    public function setEndTime(?\DateTimeInterface $endTime): void
    {
        $this->endTime = $endTime;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setStartTime(?\DateTimeInterface $startTime): void
    {
        $this->startTime = $startTime;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartDate(?\DateTimeInterface $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function addScheduleTimezone(string $scheduleTimezone): void
    {
        $this->scheduleTimezone[] = $scheduleTimezone;
    }

    public function removeScheduleTimezone(string $scheduleTimezone): void
    {
        $this->scheduleTimezone->removeElement($scheduleTimezone);
    }

    /**
     * @return Collection<Text>|null
     */
    public function getScheduleTimezone(): Collection
    {
        return $this->scheduleTimezone;
    }

    public function addByDay(string $byDay): void
    {
        $this->byDay[] = $byDay;
    }

    public function removeByDay(string $byDay): void
    {
        $this->byDay->removeElement($byDay);
    }

    /**
     * @return Collection<Text>|null
     */
    public function getByDay(): Collection
    {
        return $this->byDay;
    }

    public function setExceptDate(?\DateTimeInterface $exceptDate): void
    {
        $this->exceptDate = $exceptDate;
    }

    public function getExceptDate(): ?\DateTimeInterface
    {
        return $this->exceptDate;
    }

    public function setRepeatFrequency(Duration $repeatFrequency): void
    {
        $this->repeatFrequency = $repeatFrequency;
    }

    public function getRepeatFrequency(): Duration
    {
        return $this->repeatFrequency;
    }

    public function setRepeatCount(?int $repeatCount): void
    {
        $this->repeatCount = $repeatCount;
    }

    public function getRepeatCount(): ?int
    {
        return $this->repeatCount;
    }

    public function setDuration(?Duration $duration): void
    {
        $this->duration = $duration;
    }

    public function getDuration(): ?Duration
    {
        return $this->duration;
    }

    public function addByMonthWeek(int $byMonthWeek): void
    {
        $this->byMonthWeek[] = $byMonthWeek;
    }

    public function removeByMonthWeek(int $byMonthWeek): void
    {
        $this->byMonthWeek->removeElement($byMonthWeek);
    }

    /**
     * @return Collection<int>|null
     */
    public function getByMonthWeek(): Collection
    {
        return $this->byMonthWeek;
    }

    public function addByMonthDay(int $byMonthDay): void
    {
        $this->byMonthDay[] = $byMonthDay;
    }

    public function removeByMonthDay(int $byMonthDay): void
    {
        $this->byMonthDay->removeElement($byMonthDay);
    }

    /**
     * @return Collection<int>|null
     */
    public function getByMonthDay(): Collection
    {
        return $this->byMonthDay;
    }

    public function addByMonth(int $byMonth): void
    {
        $this->byMonth[] = $byMonth;
    }

    public function removeByMonth(int $byMonth): void
    {
        $this->byMonth->removeElement($byMonth);
    }

    /**
     * @return Collection<int>|null
     */
    public function getByMonth(): Collection
    {
        return $this->byMonth;
    }
}
