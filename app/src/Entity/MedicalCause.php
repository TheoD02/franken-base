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
 * The causative agent(s) that are responsible for the pathophysiologic process that eventually results in a medical condition, symptom or sign. In this schema, unless otherwise specified this is meant to be the proximate cause of the medical condition, symptom or sign. The proximate cause is defined as the causative agent that most directly results in the medical condition, symptom or sign. For example, the HIV virus could be considered a cause of AIDS. Or in a diagnostic context, if a patient fell and sustained a hip fracture and two days later sustained a pulmonary embolism which eventuated in a cardiac arrest, the cause of the cardiac arrest (the proximate cause) would be the pulmonary embolism and not the fall. Medical causes can include cardiovascular, chemical, dermatologic, endocrine, environmental, gastroenterologic, genetic, hematologic, gynecologic, iatrogenic, infectious, musculoskeletal, neurologic, nutritional, obstetric, oncologic, otolaryngologic, pharmacologic, psychiatric, pulmonary, renal, rheumatologic, toxic, traumatic, or urologic causes; medical conditions can be causes as well.
 *
 * @see https://schema.org/MedicalCause
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MedicalCause'])]
class MedicalCause extends MedicalEntity
{
	/**
	 * The condition, complication, symptom, sign, etc. caused.
	 *
	 * @see https://schema.org/causeOf
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MedicalEntity')]
	#[ApiProperty(types: ['https://schema.org/causeOf'])]
	private ?MedicalEntity $causeOf = null;

	public function setCauseOf(?MedicalEntity $causeOf): void
	{
		$this->causeOf = $causeOf;
	}

	public function getCauseOf(): ?MedicalEntity
	{
		return $this->causeOf;
	}
}
