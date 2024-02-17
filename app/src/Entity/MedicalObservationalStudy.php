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
use App\Enum\MedicalObservationalStudyDesign;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An observational study is a type of medical study that attempts to infer the possible effect of a treatment through observation of a cohort of subjects over a period of time. In an observational study, the assignment of subjects into treatment groups versus control groups is outside the control of the investigator. This is in contrast with controlled studies, such as the randomized controlled trials represented by MedicalTrial, where each subject is randomly assigned to a treatment group or a control group before the start of the treatment.
 *
 * @see https://schema.org/MedicalObservationalStudy
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MedicalObservationalStudy'])]
class MedicalObservationalStudy extends MedicalStudy
{
	/**
	 * Specifics about the observational study design (enumerated).
	 *
	 * @see https://schema.org/studyDesign
	 */
	#[ORM\Column]
	#[ApiProperty(types: ['https://schema.org/studyDesign'])]
	#[Assert\NotNull]
	#[Assert\Choice(callback: [MedicalObservationalStudyDesign::class, 'toArray'])]
	private string $studyDesign;

	public function setStudyDesign(string $studyDesign): void
	{
		$this->studyDesign = $studyDesign;
	}

	public function getStudyDesign(): string
	{
		return $this->studyDesign;
	}
}
