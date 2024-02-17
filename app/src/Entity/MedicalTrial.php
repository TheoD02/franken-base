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
use App\Enum\MedicalTrialDesign;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A medical trial is a type of medical study that uses a scientific process to compare the safety and efficacy of medical therapies or medical procedures. In general, medical trials are controlled and subjects are allocated at random to the different treatment and/or control groups.
 *
 * @see https://schema.org/MedicalTrial
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MedicalTrial'])]
class MedicalTrial extends MedicalStudy
{
	/**
	 * Specifics about the trial design (enumerated).
	 *
	 * @see https://schema.org/trialDesign
	 */
	#[ORM\Column]
	#[ApiProperty(types: ['https://schema.org/trialDesign'])]
	#[Assert\NotNull]
	#[Assert\Choice(callback: [MedicalTrialDesign::class, 'toArray'])]
	private string $trialDesign;

	public function setTrialDesign(string $trialDesign): void
	{
		$this->trialDesign = $trialDesign;
	}

	public function getTrialDesign(): string
	{
		return $this->trialDesign;
	}
}
