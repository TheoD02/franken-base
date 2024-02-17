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
 * Any physical manifestation of a person's medical condition discoverable by objective diagnostic tests or physical examination.
 *
 * @see https://schema.org/MedicalSign
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap(['medicalSign' => MedicalSign::class, 'vitalSign' => VitalSign::class])]
class MedicalSign extends MedicalSignOrSymptom
{
	/**
	 * A physical examination that can identify this sign.
	 *
	 * @see https://schema.org/identifyingExam
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\PhysicalExam')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/identifyingExam'])]
	#[Assert\NotNull]
	private PhysicalExam $identifyingExam;

	/**
	 * A diagnostic test that can identify this sign.
	 *
	 * @see https://schema.org/identifyingTest
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MedicalTest')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/identifyingTest'])]
	#[Assert\NotNull]
	private MedicalTest $identifyingTest;

	public function setIdentifyingExam(PhysicalExam $identifyingExam): void
	{
		$this->identifyingExam = $identifyingExam;
	}

	public function getIdentifyingExam(): PhysicalExam
	{
		return $this->identifyingExam;
	}

	public function setIdentifyingTest(MedicalTest $identifyingTest): void
	{
		$this->identifyingTest = $identifyingTest;
	}

	public function getIdentifyingTest(): MedicalTest
	{
		return $this->identifyingTest;
	}
}
