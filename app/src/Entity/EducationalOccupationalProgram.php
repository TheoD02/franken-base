<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use App\Enum\DayOfWeek;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A program offered by an institution which determines the learning progress to achieve an outcome, usually a credential like a degree or certificate. This would define a discrete set of opportunities (e.g., job, courses) that together constitute a program with a clear start, end, set of requirements, and transition to a new occupational opportunity (e.g., a job), or sometimes a higher educational opportunity (e.g., an advanced degree).
 *
 * @see https://schema.org/EducationalOccupationalProgram
 */
#[ORM\MappedSuperclass]
abstract class EducationalOccupationalProgram extends Intangible
{
    /**
     * The number of credits or units awarded by a Course or required to complete an EducationalOccupationalProgram.
     *
     * @see https://schema.org/numberOfCredits
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
    #[ApiProperty(types: ['https://schema.org/numberOfCredits'])]
    private ?int $numberOfCredits = null;

    /**
     * The service provider, service operator, or service performer; the goods producer. Another party (a seller) may offer those services or goods on behalf of the provider. A provider may also serve as the seller.
     *
     * @see https://schema.org/provider
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ApiProperty(types: ['https://schema.org/provider'])]
    private ?Person $provider = null;

    /**
     * The number of credits or units a full-time student would be expected to take in 1 term however 'term' is defined by the institution.
     *
     * @see https://schema.org/typicalCreditsPerTerm
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
    #[ApiProperty(types: ['https://schema.org/typicalCreditsPerTerm'])]
    private ?int $typicalCreditsPerTerm = null;

    /**
     * A description of the qualification, award, certificate, diploma or other educational credential awarded as a consequence of successful completion of this course or program.
     *
     * @see https://schema.org/educationalCredentialAwarded
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
    #[ApiProperty(types: ['https://schema.org/educationalCredentialAwarded'])]
    #[Assert\Url]
    private ?string $educationalCredentialAwarded = null;

    /**
     * A description of the qualification, award, certificate, diploma or other occupational credential awarded as a consequence of successful completion of this course or program.
     *
     * @see https://schema.org/occupationalCredentialAwarded
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\EducationalOccupationalCredential')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/occupationalCredentialAwarded'])]
    #[Assert\NotNull]
    private EducationalOccupationalCredential $occupationalCredentialAwarded;

    /**
     * The maximum number of students who may be enrolled in the program.
     *
     * @see https://schema.org/maximumEnrollment
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
    #[ApiProperty(types: ['https://schema.org/maximumEnrollment'])]
    private ?int $maximumEnrollment = null;

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
     * A category describing the job, preferably using a term from a taxonomy such as \[BLS O\*NET-SOC\](http://www.onetcenter.org/taxonomy.html), \[ISCO-08\](https://www.ilo.org/public/english/bureau/stat/isco/isco08/) or similar, with the property repeated for each applicable value. Ideally the taxonomy should be identified, and both the textual label and formal code for the category should be provided.\\n Note: for historical reasons, any textual label and formal code provided as a literal may be assumed to be from O\*NET-SOC.
     *
     * @see https://schema.org/occupationalCategory
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/occupationalCategory'])]
    private ?string $occupationalCategory = null;

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
     * @var string[] the day of the week for which these opening hours are valid
     *
     * @see https://schema.org/dayOfWeek
     */
    #[ORM\Column(type: 'simple_array')]
    #[ApiProperty(types: ['https://schema.org/dayOfWeek'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [DayOfWeek::class, 'toArray'], multiple: true)]
    private Collection $dayOfWeek;

    /**
     * The time of day the program normally runs. For example, "evenings".
     *
     * @see https://schema.org/timeOfDay
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/timeOfDay'])]
    private ?string $timeOfDay = null;

    /**
     * A course or class that is one of the learning opportunities that constitute an educational / occupational program. No information is implied about whether the course is mandatory or optional; no guarantee is implied about whether the course will be available to everyone on the program.
     *
     * @see https://schema.org/hasCourse
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Course')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/hasCourse'])]
    #[Assert\NotNull]
    private Course $hasCourse;

    /**
     * The number of times terms of study are offered per year. Semesters and quarters are common units for term. For example, if the student can only take 2 semesters for the program in one year, then termsPerYear should be 2.
     *
     * @see https://schema.org/termsPerYear
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/termsPerYear'])]
    private ?string $termsPerYear = null;

    /**
     * The type of educational or occupational program. For example, classroom, internship, alternance, etc.
     *
     * @see https://schema.org/programType
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\DefinedTerm')]
    #[ApiProperty(types: ['https://schema.org/programType'])]
    private ?DefinedTerm $programType = null;

    /**
     * The date at which the program stops collecting applications for the next enrollment cycle.
     *
     * @see https://schema.org/applicationDeadline
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/applicationDeadline'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $applicationDeadline = null;

    /**
     * The estimated salary earned while in the program.
     *
     * @see https://schema.org/trainingSalary
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MonetaryAmountDistribution')]
    #[ApiProperty(types: ['https://schema.org/trainingSalary'])]
    private ?MonetaryAmountDistribution $trainingSalary = null;

    /**
     * A financial aid type or program which students may use to pay for tuition or fees associated with the program.
     *
     * @see https://schema.org/financialAidEligible
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/financialAidEligible'])]
    private ?string $financialAidEligible = null;

    /**
     * Prerequisites for enrolling in the program.
     *
     * @see https://schema.org/programPrerequisites
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\EducationalOccupationalCredential')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/programPrerequisites'])]
    #[Assert\NotNull]
    private EducationalOccupationalCredential $programPrerequisites;

    /**
     * @var Collection<Duration>|null The amount of time in a term as defined by the institution. A term is a length of time where students take one or more classes. Semesters and quarters are common units for term.
     *
     * @see https://schema.org/termDuration
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Duration')]
    #[ORM\JoinTable(name: 'educational_occupational_program_duration_term_duration')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/termDuration'])]
    private ?Collection $termDuration = null;

    /**
     * The expected length of time to complete the program if attending full-time.
     *
     * @see https://schema.org/timeToComplete
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Duration')]
    #[ApiProperty(types: ['https://schema.org/timeToComplete'])]
    private ?Duration $timeToComplete = null;

    /**
     * Similar to courseMode, the medium or means of delivery of the program as a whole. The value may either be a text label (e.g. "online", "onsite" or "blended"; "synchronous" or "asynchronous"; "full-time" or "part-time") or a URL reference to a term from a controlled vocabulary (e.g. https://ceds.ed.gov/element/001311#Asynchronous ).
     *
     * @see https://schema.org/educationalProgramMode
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/educationalProgramMode'])]
    private ?string $educationalProgramMode = null;

    /**
     * The date at which the program begins collecting applications for the next enrollment cycle.
     *
     * @see https://schema.org/applicationStartDate
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/applicationStartDate'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $applicationStartDate = null;

    /**
     * The expected salary upon completing the training.
     *
     * @see https://schema.org/salaryUponCompletion
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MonetaryAmountDistribution')]
    #[ApiProperty(types: ['https://schema.org/salaryUponCompletion'])]
    private ?MonetaryAmountDistribution $salaryUponCompletion = null;

    /**
     * @var Collection<Demand>|null An offer to provide this item—for example, an offer to sell a product, rent the DVD of a movie, perform a service, or give away tickets to an event. Use \[\[businessFunction\]\] to indicate the kind of transaction offered, i.e. sell, lease, etc. This property can also be used to describe a \[\[Demand\]\]. While this property is listed as expected on a number of common types, it can be used in others. In that case, using a second type, such as Product or a subtype of Product, can clarify the nature of the offer.
     *
     * @see https://schema.org/offers
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Demand')]
    #[ORM\JoinTable(name: 'educational_occupational_program_demand_offers')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/offers'])]
    private ?Collection $offers = null;

    public function __construct()
    {
        $this->termDuration = new ArrayCollection();
        $this->offers = new ArrayCollection();
    }

    public function setNumberOfCredits(?int $numberOfCredits): void
    {
        $this->numberOfCredits = $numberOfCredits;
    }

    public function getNumberOfCredits(): ?int
    {
        return $this->numberOfCredits;
    }

    public function setProvider(?Person $provider): void
    {
        $this->provider = $provider;
    }

    public function getProvider(): ?Person
    {
        return $this->provider;
    }

    public function setTypicalCreditsPerTerm(?int $typicalCreditsPerTerm): void
    {
        $this->typicalCreditsPerTerm = $typicalCreditsPerTerm;
    }

    public function getTypicalCreditsPerTerm(): ?int
    {
        return $this->typicalCreditsPerTerm;
    }

    public function setEducationalCredentialAwarded(?string $educationalCredentialAwarded): void
    {
        $this->educationalCredentialAwarded = $educationalCredentialAwarded;
    }

    public function getEducationalCredentialAwarded(): ?string
    {
        return $this->educationalCredentialAwarded;
    }

    public function setOccupationalCredentialAwarded(
        EducationalOccupationalCredential $occupationalCredentialAwarded,
    ): void {
        $this->occupationalCredentialAwarded = $occupationalCredentialAwarded;
    }

    public function getOccupationalCredentialAwarded(): EducationalOccupationalCredential
    {
        return $this->occupationalCredentialAwarded;
    }

    public function setMaximumEnrollment(?int $maximumEnrollment): void
    {
        $this->maximumEnrollment = $maximumEnrollment;
    }

    public function getMaximumEnrollment(): ?int
    {
        return $this->maximumEnrollment;
    }

    public function setStartDate(?\DateTimeInterface $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setOccupationalCategory(?string $occupationalCategory): void
    {
        $this->occupationalCategory = $occupationalCategory;
    }

    public function getOccupationalCategory(): ?string
    {
        return $this->occupationalCategory;
    }

    public function setEndDate(?\DateTimeInterface $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function addDayOfWeek($dayOfWeek): void
    {
        $this->dayOfWeek[] = (string) $dayOfWeek;
    }

    public function removeDayOfWeek(string $dayOfWeek): void
    {
        if (false !== $key = array_search((string) $dayOfWeek, $this->dayOfWeek, true)) {
            unset($this->dayOfWeek[$key]);
        }
    }

    /**
     * @return string[]
     */
    public function getDayOfWeek(): Collection
    {
        return $this->dayOfWeek;
    }

    public function setTimeOfDay(?string $timeOfDay): void
    {
        $this->timeOfDay = $timeOfDay;
    }

    public function getTimeOfDay(): ?string
    {
        return $this->timeOfDay;
    }

    public function setHasCourse(Course $hasCourse): void
    {
        $this->hasCourse = $hasCourse;
    }

    public function getHasCourse(): Course
    {
        return $this->hasCourse;
    }

    public function setTermsPerYear(?string $termsPerYear): void
    {
        $this->termsPerYear = $termsPerYear;
    }

    public function getTermsPerYear(): ?string
    {
        return $this->termsPerYear;
    }

    public function setProgramType(?DefinedTerm $programType): void
    {
        $this->programType = $programType;
    }

    public function getProgramType(): ?DefinedTerm
    {
        return $this->programType;
    }

    public function setApplicationDeadline(?\DateTimeInterface $applicationDeadline): void
    {
        $this->applicationDeadline = $applicationDeadline;
    }

    public function getApplicationDeadline(): ?\DateTimeInterface
    {
        return $this->applicationDeadline;
    }

    public function setTrainingSalary(?MonetaryAmountDistribution $trainingSalary): void
    {
        $this->trainingSalary = $trainingSalary;
    }

    public function getTrainingSalary(): ?MonetaryAmountDistribution
    {
        return $this->trainingSalary;
    }

    public function setFinancialAidEligible(?string $financialAidEligible): void
    {
        $this->financialAidEligible = $financialAidEligible;
    }

    public function getFinancialAidEligible(): ?string
    {
        return $this->financialAidEligible;
    }

    public function setProgramPrerequisites(EducationalOccupationalCredential $programPrerequisites): void
    {
        $this->programPrerequisites = $programPrerequisites;
    }

    public function getProgramPrerequisites(): EducationalOccupationalCredential
    {
        return $this->programPrerequisites;
    }

    public function addTermDuration(Duration $termDuration): void
    {
        $this->termDuration[] = $termDuration;
    }

    public function removeTermDuration(Duration $termDuration): void
    {
        $this->termDuration->removeElement($termDuration);
    }

    /**
     * @return Collection<Duration>|null
     */
    public function getTermDuration(): Collection
    {
        return $this->termDuration;
    }

    public function setTimeToComplete(?Duration $timeToComplete): void
    {
        $this->timeToComplete = $timeToComplete;
    }

    public function getTimeToComplete(): ?Duration
    {
        return $this->timeToComplete;
    }

    public function setEducationalProgramMode(?string $educationalProgramMode): void
    {
        $this->educationalProgramMode = $educationalProgramMode;
    }

    public function getEducationalProgramMode(): ?string
    {
        return $this->educationalProgramMode;
    }

    public function setApplicationStartDate(?\DateTimeInterface $applicationStartDate): void
    {
        $this->applicationStartDate = $applicationStartDate;
    }

    public function getApplicationStartDate(): ?\DateTimeInterface
    {
        return $this->applicationStartDate;
    }

    public function setSalaryUponCompletion(?MonetaryAmountDistribution $salaryUponCompletion): void
    {
        $this->salaryUponCompletion = $salaryUponCompletion;
    }

    public function getSalaryUponCompletion(): ?MonetaryAmountDistribution
    {
        return $this->salaryUponCompletion;
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
}
