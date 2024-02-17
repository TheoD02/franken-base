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
 * A set of defined terms, for example a set of categories or a classification scheme, a glossary, dictionary or enumeration.
 *
 * @see https://schema.org/DefinedTermSet
 */
#[ORM\MappedSuperclass]
abstract class DefinedTermSet extends CreativeWork
{
	/**
	 * A Defined Term contained in this term set.
	 *
	 * @see https://schema.org/hasDefinedTerm
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\DefinedTerm')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/hasDefinedTerm'])]
	#[Assert\NotNull]
	private DefinedTerm $hasDefinedTerm;

	public function setHasDefinedTerm(DefinedTerm $hasDefinedTerm): void
	{
		$this->hasDefinedTerm = $hasDefinedTerm;
	}

	public function getHasDefinedTerm(): DefinedTerm
	{
		return $this->hasDefinedTerm;
	}
}
