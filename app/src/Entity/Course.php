<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A description of an educational course which may be offered as distinct instances which take place at different times or take place at different locations, or be offered through different media or modes of study. An educational course is a sequence of one or more educational events and/or creative works which aims to build knowledge, competence or ability of learners.
 *
 * @see https://schema.org/Course
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Course'])]
class Course extends LearningResource
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
	 * A language someone may use with or at the item, service or place. Please use one of the language codes from the \[IETF BCP 47 standard\](http://tools.ietf.org/html/bcp47). See also \[\[inLanguage\]\].
	 *
	 * @see https://schema.org/availableLanguage
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Language')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/availableLanguage'])]
	#[Assert\NotNull]
	private Language $availableLanguage;

	/**
	 * An offering of the course at a specific time and place or through specific media or mode of study or to a specific section of students.
	 *
	 * @see https://schema.org/hasCourseInstance
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\CourseInstance')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/hasCourseInstance'])]
	#[Assert\NotNull]
	private CourseInstance $hasCourseInstance;

	/**
	 * Indicates (typically several) Syllabus entities that lay out what each section of the overall course will cover.
	 *
	 * @see https://schema.org/syllabusSections
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Syllabus')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/syllabusSections'])]
	#[Assert\NotNull]
	private Syllabus $syllabusSections;

	/**
	 * The total number of students that have enrolled in the history of the course.
	 *
	 * @see https://schema.org/totalHistoricalEnrollment
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
	#[ApiProperty(types: ['https://schema.org/totalHistoricalEnrollment'])]
	private ?int $totalHistoricalEnrollment = null;

	/**
	 * A financial aid type or program which students may use to pay for tuition or fees associated with the program.
	 *
	 * @see https://schema.org/financialAidEligible
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/financialAidEligible'])]
	private ?string $financialAidEligible = null;

	/**
	 * Requirements for taking the Course. May be completion of another \[\[Course\]\] or a textual description like "permission of instructor". Requirements may be a pre-requisite competency, referenced using \[\[AlignmentObject\]\].
	 *
	 * @see https://schema.org/coursePrerequisites
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Course')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/coursePrerequisites'])]
	#[Assert\NotNull]
	private Course $coursePrerequisites;

	/**
	 * The identifier for the \[\[Course\]\] used by the course \[\[provider\]\] (e.g. CS101 or 6.001).
	 *
	 * @see https://schema.org/courseCode
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/courseCode'])]
	private ?string $courseCode = null;

	public function setNumberOfCredits(?int $numberOfCredits): void
	{
		$this->numberOfCredits = $numberOfCredits;
	}

	public function getNumberOfCredits(): ?int
	{
		return $this->numberOfCredits;
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
	): void
	{
		$this->occupationalCredentialAwarded = $occupationalCredentialAwarded;
	}

	public function getOccupationalCredentialAwarded(): EducationalOccupationalCredential
	{
		return $this->occupationalCredentialAwarded;
	}

	public function setAvailableLanguage(Language $availableLanguage): void
	{
		$this->availableLanguage = $availableLanguage;
	}

	public function getAvailableLanguage(): Language
	{
		return $this->availableLanguage;
	}

	public function setHasCourseInstance(CourseInstance $hasCourseInstance): void
	{
		$this->hasCourseInstance = $hasCourseInstance;
	}

	public function getHasCourseInstance(): CourseInstance
	{
		return $this->hasCourseInstance;
	}

	public function setSyllabusSections(Syllabus $syllabusSections): void
	{
		$this->syllabusSections = $syllabusSections;
	}

	public function getSyllabusSections(): Syllabus
	{
		return $this->syllabusSections;
	}

	public function setTotalHistoricalEnrollment(?int $totalHistoricalEnrollment): void
	{
		$this->totalHistoricalEnrollment = $totalHistoricalEnrollment;
	}

	public function getTotalHistoricalEnrollment(): ?int
	{
		return $this->totalHistoricalEnrollment;
	}

	public function setFinancialAidEligible(?string $financialAidEligible): void
	{
		$this->financialAidEligible = $financialAidEligible;
	}

	public function getFinancialAidEligible(): ?string
	{
		return $this->financialAidEligible;
	}

	public function setCoursePrerequisites(Course $coursePrerequisites): void
	{
		$this->coursePrerequisites = $coursePrerequisites;
	}

	public function getCoursePrerequisites(): Course
	{
		return $this->coursePrerequisites;
	}

	public function setCourseCode(?string $courseCode): void
	{
		$this->courseCode = $courseCode;
	}

	public function getCourseCode(): ?string
	{
		return $this->courseCode;
	}
}
