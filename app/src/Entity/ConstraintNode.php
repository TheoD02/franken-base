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
 * The ConstraintNode type is provided to support usecases in which a node in a structured data graph is described with properties which appear to describe a single entity, but are being used in a situation where they serve a more abstract purpose. A \[\[ConstraintNode\]\] can be described using \[\[constraintProperty\]\] and \[\[numConstraints\]\]. These constraint properties can serve a variety of purposes, and their values may sometimes be understood to indicate sets of possible values rather than single, exact and specific values.
 *
 * @see https://schema.org/ConstraintNode
 */
#[ORM\MappedSuperclass]
abstract class ConstraintNode extends Intangible
{
	/**
	 * Indicates a property used as a constraint. For example, in the definition of a \[\[StatisticalVariable\]\]. The value is a property, either from within Schema.org or from other compatible (e.g. RDF) systems such as DataCommons.org or Wikidata.org.
	 *
	 * @see https://schema.org/constraintProperty
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/constraintProperty'])]
	#[Assert\Url]
	private ?string $constraintProperty = null;

	/**
	 * Indicates the number of constraints property values defined for a particular \[\[ConstraintNode\]\] such as \[\[StatisticalVariable\]\]. This helps applications understand if they have access to a sufficiently complete description of a \[\[StatisticalVariable\]\] or other construct that is defined using properties on template-style nodes.
	 *
	 * @see https://schema.org/numConstraints
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Integer')]
	#[ApiProperty(types: ['https://schema.org/numConstraints'])]
	private ?int $numConstraints = null;

	public function setConstraintProperty(?string $constraintProperty): void
	{
		$this->constraintProperty = $constraintProperty;
	}

	public function getConstraintProperty(): ?string
	{
		return $this->constraintProperty;
	}

	public function setNumConstraints(?int $numConstraints): void
	{
		$this->numConstraints = $numConstraints;
	}

	public function getNumConstraints(): ?int
	{
		return $this->numConstraints;
	}
}
