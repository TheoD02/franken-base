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
 * A class of medical drugs, e.g., statins. Classes can represent general pharmacological class, common mechanisms of action, common physiological effects, etc.
 *
 * @see https://schema.org/DrugClass
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DrugClass'])]
class DrugClass extends MedicalEntity
{
	/**
	 * Specifying a drug or medicine used in a medication procedure.
	 *
	 * @see https://schema.org/drug
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Drug')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/drug'])]
	#[Assert\NotNull]
	private Drug $drug;

	public function setDrug(Drug $drug): void
	{
		$this->drug = $drug;
	}

	public function getDrug(): Drug
	{
		return $this->drug;
	}
}
