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
 * A listing that describes a job opening in a certain organization.
 *
 * @see https://schema.org/JobPosting
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/JobPosting'])]
class JobPosting extends Intangible
{
    /**
     * An indicator as to whether a position is available for an immediate start.
     *
     * @see https://schema.org/jobImmediateStart
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Boolean')]
    #[ApiProperty(types: ['https://schema.org/jobImmediateStart'])]
    private ?bool $jobImmediateStart = null;

    /**
     * The legal requirements such as citizenship, visa and other documentation required for an applicant to this job.
     *
     * @see https://schema.org/eligibilityToWorkRequirement
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/eligibilityToWorkRequirement'])]
    private ?string $eligibilityToWorkRequirement = null;

    /**
     * Specific qualifications required for this role or Occupation.
     *
     * @see https://schema.org/qualifications
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\EducationalOccupationalCredential')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/qualifications'])]
    #[Assert\NotNull]
    private EducationalOccupationalCredential $qualifications;

    /**
     * Type of employment (e.g. full-time, part-time, contract, temporary, seasonal, internship).
     *
     * @see https://schema.org/employmentType
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/employmentType'])]
    private ?string $employmentType = null;

    /**
     * The date on which a successful applicant for this job would be expected to start work. Choose a specific date in the future or use the jobImmediateStart property to indicate the position is to be filled as soon as possible.
     *
     * @see https://schema.org/jobStartDate
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/jobStartDate'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $jobStartDate = null;

    /**
     * Publication date of an online listing.
     *
     * @see https://schema.org/datePosted
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/datePosted'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $datePosted = null;

    /**
     * Indicates whether a \[\[JobPosting\]\] will accept experience (as indicated by \[\[OccupationalExperienceRequirements\]\]) in place of its formal educational qualifications (as indicated by \[\[educationRequirements\]\]). If true, indicates that satisfying one of these requirements is sufficient.
     *
     * @see https://schema.org/experienceInPlaceOfEducation
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Boolean')]
    #[ApiProperty(types: ['https://schema.org/experienceInPlaceOfEducation'])]
    private ?bool $experienceInPlaceOfEducation = null;

    /**
     * Responsibilities associated with this role or Occupation.
     *
     * @see https://schema.org/responsibilities
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/responsibilities'])]
    private ?string $responsibilities = null;

    /**
     * The industry associated with the job position.
     *
     * @see https://schema.org/industry
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/industry'])]
    private ?string $industry = null;

    /**
     * Educational background needed for the position or Occupation.
     *
     * @see https://schema.org/educationRequirements
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/educationRequirements'])]
    private ?string $educationRequirements = null;

    /**
     * A description of any sensory requirements and levels necessary to function on the job, including hearing and vision. Defined terms such as those in O\*net may be used, but note that there is no way to specify the level of ability as well as its nature when using a defined term.
     *
     * @see https://schema.org/sensoryRequirement
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/sensoryRequirement'])]
    private ?string $sensoryRequirement = null;

    /**
     * A category describing the job, preferably using a term from a taxonomy such as \[BLS O\*NET-SOC\](http://www.onetcenter.org/taxonomy.html), \[ISCO-08\](https://www.ilo.org/public/english/bureau/stat/isco/isco08/) or similar, with the property repeated for each applicable value. Ideally the taxonomy should be identified, and both the textual label and formal code for the category should be provided.\\n Note: for historical reasons, any textual label and formal code provided as a literal may be assumed to be from O\*NET-SOC.
     *
     * @see https://schema.org/occupationalCategory
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/occupationalCategory'])]
    private ?string $occupationalCategory = null;

    /**
     * @var Collection<AdministrativeArea>|null The location(s) applicants can apply from. This is usually used for telecommuting jobs where the applicant does not need to be in a physical office. Note: This should not be used for citizenship or work visa requirements.
     *
     * @see https://schema.org/applicantLocationRequirements
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\AdministrativeArea')]
    #[ORM\JoinTable(name: 'job_posting_administrative_area_applicant_location_requirements')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/applicantLocationRequirements'])]
    private ?Collection $applicantLocationRequirements = null;

    /**
     * A description of the job location (e.g. TELECOMMUTE for telecommute jobs).
     *
     * @see https://schema.org/jobLocationType
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/jobLocationType'])]
    private ?string $jobLocationType = null;

    /**
     * A description of the types of physical activity associated with the job. Defined terms such as those in O\*net may be used, but note that there is no way to specify the level of ability as well as its nature when using a defined term.
     *
     * @see https://schema.org/physicalRequirement
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\DefinedTerm')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/physicalRequirement'])]
    #[Assert\NotNull]
    private DefinedTerm $physicalRequirement;

    /**
     * A statement of knowledge, skill, ability, task or any other assertion expressing a competency that is desired or required to fulfill this role or to work in this occupation.
     *
     * @see https://schema.org/skills
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\DefinedTerm')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/skills'])]
    #[Assert\NotNull]
    private DefinedTerm $skills;

    /**
     * A description of any security clearance requirements of the job.
     *
     * @see https://schema.org/securityClearanceRequirement
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/securityClearanceRequirement'])]
    private ?string $securityClearanceRequirement = null;

    /**
     * An estimated salary for a job posting or occupation, based on a variety of variables including, but not limited to industry, job title, and location. Estimated salaries are often computed by outside organizations rather than the hiring organization, who may not have committed to the estimated value.
     *
     * @see https://schema.org/estimatedSalary
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MonetaryAmountDistribution')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/estimatedSalary'])]
    #[Assert\NotNull]
    private MonetaryAmountDistribution $estimatedSalary;

    /**
     * The base salary of the job or of an employee in an EmployeeRole.
     *
     * @see https://schema.org/baseSalary
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\PriceSpecification')]
    #[ApiProperty(types: ['https://schema.org/baseSalary'])]
    private ?PriceSpecification $baseSalary = null;

    /**
     * @var Collection<bool>|null Indicates whether an \[\[url\]\] that is associated with a \[\[JobPosting\]\] enables direct application for the job, via the posting website. A job posting is considered to have directApply of \[\[True\]\] if an application process for the specified job can be directly initiated via the url(s) given (noting that e.g. multiple internet domains might nevertheless be involved at an implementation level). A value of \[\[False\]\] is appropriate if there is no clear path to applying directly online for the specified job, navigating directly from the JobPosting url(s) supplied.
     *
     * @see https://schema.org/directApply
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Boolean')]
    #[ORM\JoinTable(name: 'job_posting_boolean_direct_apply')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/directApply'])]
    private ?Collection $directApply = null;

    /**
     * The title of the job.
     *
     * @see https://schema.org/title
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/title'])]
    private ?string $title = null;

    /**
     * Description of benefits associated with the job.
     *
     * @see https://schema.org/jobBenefits
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/jobBenefits'])]
    private ?string $jobBenefits = null;

    /**
     * Organization or Person offering the job position.
     *
     * @see https://schema.org/hiringOrganization
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/hiringOrganization'])]
    #[Assert\NotNull]
    private Organization $hiringOrganization;

    /**
     * Indicates the department, unit and/or facility where the employee reports and/or in which the job is to be performed.
     *
     * @see https://schema.org/employmentUnit
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/employmentUnit'])]
    #[Assert\NotNull]
    private Organization $employmentUnit;

    /**
     * A (typically single) geographic location associated with the job position.
     *
     * @see https://schema.org/jobLocation
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Place')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/jobLocation'])]
    #[Assert\NotNull]
    private Place $jobLocation;

    /**
     * Description of skills and experience needed for the position or Occupation.
     *
     * @see https://schema.org/experienceRequirements
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/experienceRequirements'])]
    private ?string $experienceRequirements = null;

    /**
     * The typical working hours for this job (e.g. 1st shift, night shift, 8am-5pm).
     *
     * @see https://schema.org/workHours
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/workHours'])]
    private ?string $workHours = null;

    /**
     * The date after when the item is not valid. For example the end of an offer, salary period, or a period of opening hours.
     *
     * @see https://schema.org/validThrough
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/validThrough'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $validThrough = null;

    /**
     * The number of positions open for this job posting. Use a positive integer. Do not use if the number of positions is unclear or not known.
     *
     * @see https://schema.org/totalJobOpenings
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
    #[ApiProperty(types: ['https://schema.org/totalJobOpenings'])]
    private ?int $totalJobOpenings = null;

    /**
     * The currency (coded using \[ISO 4217\](http://en.wikipedia.org/wiki/ISO\_4217)) used for the main salary information in this job posting or for this employee.
     *
     * @see https://schema.org/salaryCurrency
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/salaryCurrency'])]
    private ?string $salaryCurrency = null;

    /**
     * A description of the employer, career opportunities and work environment for this position.
     *
     * @see https://schema.org/employerOverview
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/employerOverview'])]
    private ?string $employerOverview = null;

    /**
     * Contact details for further information relevant to this job posting.
     *
     * @see https://schema.org/applicationContact
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\ContactPoint')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/applicationContact'])]
    #[Assert\NotNull]
    private ContactPoint $applicationContact;

    /**
     * Description of bonus and commission compensation aspects of the job.
     *
     * @see https://schema.org/incentiveCompensation
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/incentiveCompensation'])]
    private ?string $incentiveCompensation = null;

    /**
     * The Occupation for the JobPosting.
     *
     * @see https://schema.org/relevantOccupation
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Occupation')]
    #[ApiProperty(types: ['https://schema.org/relevantOccupation'])]
    private ?Occupation $relevantOccupation = null;

    /**
     * Any special commitments associated with this job posting. Valid entries include VeteranCommit, MilitarySpouseCommit, etc.
     *
     * @see https://schema.org/specialCommitments
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/specialCommitments'])]
    private ?string $specialCommitments = null;

    public function __construct()
    {
        $this->applicantLocationRequirements = new ArrayCollection();
        $this->directApply = new ArrayCollection();
    }

    public function setJobImmediateStart(?bool $jobImmediateStart): void
    {
        $this->jobImmediateStart = $jobImmediateStart;
    }

    public function getJobImmediateStart(): ?bool
    {
        return $this->jobImmediateStart;
    }

    public function setEligibilityToWorkRequirement(?string $eligibilityToWorkRequirement): void
    {
        $this->eligibilityToWorkRequirement = $eligibilityToWorkRequirement;
    }

    public function getEligibilityToWorkRequirement(): ?string
    {
        return $this->eligibilityToWorkRequirement;
    }

    public function setQualifications(EducationalOccupationalCredential $qualifications): void
    {
        $this->qualifications = $qualifications;
    }

    public function getQualifications(): EducationalOccupationalCredential
    {
        return $this->qualifications;
    }

    public function setEmploymentType(?string $employmentType): void
    {
        $this->employmentType = $employmentType;
    }

    public function getEmploymentType(): ?string
    {
        return $this->employmentType;
    }

    public function setJobStartDate(?\DateTimeInterface $jobStartDate): void
    {
        $this->jobStartDate = $jobStartDate;
    }

    public function getJobStartDate(): ?\DateTimeInterface
    {
        return $this->jobStartDate;
    }

    public function setDatePosted(?\DateTimeInterface $datePosted): void
    {
        $this->datePosted = $datePosted;
    }

    public function getDatePosted(): ?\DateTimeInterface
    {
        return $this->datePosted;
    }

    public function setExperienceInPlaceOfEducation(?bool $experienceInPlaceOfEducation): void
    {
        $this->experienceInPlaceOfEducation = $experienceInPlaceOfEducation;
    }

    public function getExperienceInPlaceOfEducation(): ?bool
    {
        return $this->experienceInPlaceOfEducation;
    }

    public function setResponsibilities(?string $responsibilities): void
    {
        $this->responsibilities = $responsibilities;
    }

    public function getResponsibilities(): ?string
    {
        return $this->responsibilities;
    }

    public function setIndustry(?string $industry): void
    {
        $this->industry = $industry;
    }

    public function getIndustry(): ?string
    {
        return $this->industry;
    }

    public function setEducationRequirements(?string $educationRequirements): void
    {
        $this->educationRequirements = $educationRequirements;
    }

    public function getEducationRequirements(): ?string
    {
        return $this->educationRequirements;
    }

    public function setSensoryRequirement(?string $sensoryRequirement): void
    {
        $this->sensoryRequirement = $sensoryRequirement;
    }

    public function getSensoryRequirement(): ?string
    {
        return $this->sensoryRequirement;
    }

    public function setOccupationalCategory(?string $occupationalCategory): void
    {
        $this->occupationalCategory = $occupationalCategory;
    }

    public function getOccupationalCategory(): ?string
    {
        return $this->occupationalCategory;
    }

    public function addApplicantLocationRequirement(AdministrativeArea $applicantLocationRequirement): void
    {
        $this->applicantLocationRequirements[] = $applicantLocationRequirement;
    }

    public function removeApplicantLocationRequirement(AdministrativeArea $applicantLocationRequirement): void
    {
        $this->applicantLocationRequirements->removeElement($applicantLocationRequirement);
    }

    /**
     * @return Collection<AdministrativeArea>|null
     */
    public function getApplicantLocationRequirements(): Collection
    {
        return $this->applicantLocationRequirements;
    }

    public function setJobLocationType(?string $jobLocationType): void
    {
        $this->jobLocationType = $jobLocationType;
    }

    public function getJobLocationType(): ?string
    {
        return $this->jobLocationType;
    }

    public function setPhysicalRequirement(DefinedTerm $physicalRequirement): void
    {
        $this->physicalRequirement = $physicalRequirement;
    }

    public function getPhysicalRequirement(): DefinedTerm
    {
        return $this->physicalRequirement;
    }

    public function setSkills(DefinedTerm $skills): void
    {
        $this->skills = $skills;
    }

    public function getSkills(): DefinedTerm
    {
        return $this->skills;
    }

    public function setSecurityClearanceRequirement(?string $securityClearanceRequirement): void
    {
        $this->securityClearanceRequirement = $securityClearanceRequirement;
    }

    public function getSecurityClearanceRequirement(): ?string
    {
        return $this->securityClearanceRequirement;
    }

    public function setEstimatedSalary(MonetaryAmountDistribution $estimatedSalary): void
    {
        $this->estimatedSalary = $estimatedSalary;
    }

    public function getEstimatedSalary(): MonetaryAmountDistribution
    {
        return $this->estimatedSalary;
    }

    public function setBaseSalary(?PriceSpecification $baseSalary): void
    {
        $this->baseSalary = $baseSalary;
    }

    public function getBaseSalary(): ?PriceSpecification
    {
        return $this->baseSalary;
    }

    public function addDirectApply(bool $directApply): void
    {
        $this->directApply[] = $directApply;
    }

    public function removeDirectApply(bool $directApply): void
    {
        $this->directApply->removeElement($directApply);
    }

    /**
     * @return Collection<bool>|null
     */
    public function getDirectApply(): Collection
    {
        return $this->directApply;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setJobBenefits(?string $jobBenefits): void
    {
        $this->jobBenefits = $jobBenefits;
    }

    public function getJobBenefits(): ?string
    {
        return $this->jobBenefits;
    }

    public function setHiringOrganization(Organization $hiringOrganization): void
    {
        $this->hiringOrganization = $hiringOrganization;
    }

    public function getHiringOrganization(): Organization
    {
        return $this->hiringOrganization;
    }

    public function setEmploymentUnit(Organization $employmentUnit): void
    {
        $this->employmentUnit = $employmentUnit;
    }

    public function getEmploymentUnit(): Organization
    {
        return $this->employmentUnit;
    }

    public function setJobLocation(Place $jobLocation): void
    {
        $this->jobLocation = $jobLocation;
    }

    public function getJobLocation(): Place
    {
        return $this->jobLocation;
    }

    public function setExperienceRequirements(?string $experienceRequirements): void
    {
        $this->experienceRequirements = $experienceRequirements;
    }

    public function getExperienceRequirements(): ?string
    {
        return $this->experienceRequirements;
    }

    public function setWorkHours(?string $workHours): void
    {
        $this->workHours = $workHours;
    }

    public function getWorkHours(): ?string
    {
        return $this->workHours;
    }

    public function setValidThrough(?\DateTimeInterface $validThrough): void
    {
        $this->validThrough = $validThrough;
    }

    public function getValidThrough(): ?\DateTimeInterface
    {
        return $this->validThrough;
    }

    public function setTotalJobOpenings(?int $totalJobOpenings): void
    {
        $this->totalJobOpenings = $totalJobOpenings;
    }

    public function getTotalJobOpenings(): ?int
    {
        return $this->totalJobOpenings;
    }

    public function setSalaryCurrency(?string $salaryCurrency): void
    {
        $this->salaryCurrency = $salaryCurrency;
    }

    public function getSalaryCurrency(): ?string
    {
        return $this->salaryCurrency;
    }

    public function setEmployerOverview(?string $employerOverview): void
    {
        $this->employerOverview = $employerOverview;
    }

    public function getEmployerOverview(): ?string
    {
        return $this->employerOverview;
    }

    public function setApplicationContact(ContactPoint $applicationContact): void
    {
        $this->applicationContact = $applicationContact;
    }

    public function getApplicationContact(): ContactPoint
    {
        return $this->applicationContact;
    }

    public function setIncentiveCompensation(?string $incentiveCompensation): void
    {
        $this->incentiveCompensation = $incentiveCompensation;
    }

    public function getIncentiveCompensation(): ?string
    {
        return $this->incentiveCompensation;
    }

    public function setRelevantOccupation(?Occupation $relevantOccupation): void
    {
        $this->relevantOccupation = $relevantOccupation;
    }

    public function getRelevantOccupation(): ?Occupation
    {
        return $this->relevantOccupation;
    }

    public function setSpecialCommitments(?string $specialCommitments): void
    {
        $this->specialCommitments = $specialCommitments;
    }

    public function getSpecialCommitments(): ?string
    {
        return $this->specialCommitments;
    }
}
