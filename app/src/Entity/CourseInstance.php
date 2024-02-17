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
 * An instance of a \[\[Course\]\] which is distinct from other instances because it is offered at a different time or location or through different media or modes of study or to a specific section of students.
 *
 * @see https://schema.org/CourseInstance
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/CourseInstance'])]
class CourseInstance extends Event
{
	/**
	 * The amount of work expected of students taking the course, often provided as a figure per week or per month, and may be broken down by type. For example, "2 hours of lectures, 1 hour of lab work and 3 hours of independent study per week".
	 *
	 * @see https://schema.org/courseWorkload
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/courseWorkload'])]
	private ?string $courseWorkload = null;

	/**
	 * The medium or means of delivery of the course instance or the mode of study, either as a text label (e.g. "online", "onsite" or "blended"; "synchronous" or "asynchronous"; "full-time" or "part-time") or as a URL reference to a term from a controlled vocabulary (e.g. https://ceds.ed.gov/element/001311#Asynchronous).
	 *
	 * @see https://schema.org/courseMode
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/courseMode'])]
	private ?string $courseMode = null;

	/**
	 * A person assigned to instruct or provide instructional assistance for the \[\[CourseInstance\]\].
	 *
	 * @see https://schema.org/instructor
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/instructor'])]
	#[Assert\NotNull]
	private Person $instructor;

	/**
	 * Represents the length and pace of a course, expressed as a \[\[Schedule\]\].
	 *
	 * @see https://schema.org/courseSchedule
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Schedule')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/courseSchedule'])]
	#[Assert\NotNull]
	private Schedule $courseSchedule;

	public function setCourseWorkload(?string $courseWorkload): void
	{
		$this->courseWorkload = $courseWorkload;
	}

	public function getCourseWorkload(): ?string
	{
		return $this->courseWorkload;
	}

	public function setCourseMode(?string $courseMode): void
	{
		$this->courseMode = $courseMode;
	}

	public function getCourseMode(): ?string
	{
		return $this->courseMode;
	}

	public function setInstructor(Person $instructor): void
	{
		$this->instructor = $instructor;
	}

	public function getInstructor(): Person
	{
		return $this->instructor;
	}

	public function setCourseSchedule(Schedule $courseSchedule): void
	{
		$this->courseSchedule = $courseSchedule;
	}

	public function getCourseSchedule(): Schedule
	{
		return $this->courseSchedule;
	}
}
