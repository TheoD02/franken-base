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
use App\Enum\InfectiousAgentClass;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An infectious disease is a clinically evident human disease resulting from the presence of pathogenic microbial agents, like pathogenic viruses, pathogenic bacteria, fungi, protozoa, multicellular parasites, and prions. To be considered an infectious disease, such pathogens are known to be able to cause this disease.
 *
 * @see https://schema.org/InfectiousDisease
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/InfectiousDisease'])]
class InfectiousDisease extends MedicalCondition
{
	/**
	 * The class of infectious agent (bacteria, prion, etc.) that causes the disease.
	 *
	 * @see https://schema.org/infectiousAgentClass
	 */
	#[ORM\Column(nullable: true)]
	#[ApiProperty(types: ['https://schema.org/infectiousAgentClass'])]
	#[Assert\Choice(callback: [InfectiousAgentClass::class, 'toArray'])]
	private ?string $infectiousAgentClass = null;

	/**
	 * The actual infectious agent, such as a specific bacterium.
	 *
	 * @see https://schema.org/infectiousAgent
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/infectiousAgent'])]
	private ?string $infectiousAgent = null;

	/**
	 * How the disease spreads, either as a route or vector, for example 'direct contact', 'Aedes aegypti', etc.
	 *
	 * @see https://schema.org/transmissionMethod
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/transmissionMethod'])]
	private ?string $transmissionMethod = null;

	public function setInfectiousAgentClass(?string $infectiousAgentClass): void
	{
		$this->infectiousAgentClass = $infectiousAgentClass;
	}

	public function getInfectiousAgentClass(): ?string
	{
		return $this->infectiousAgentClass;
	}

	public function setInfectiousAgent(?string $infectiousAgent): void
	{
		$this->infectiousAgent = $infectiousAgent;
	}

	public function getInfectiousAgent(): ?string
	{
		return $this->infectiousAgent;
	}

	public function setTransmissionMethod(?string $transmissionMethod): void
	{
		$this->transmissionMethod = $transmissionMethod;
	}

	public function getTransmissionMethod(): ?string
	{
		return $this->transmissionMethod;
	}
}
