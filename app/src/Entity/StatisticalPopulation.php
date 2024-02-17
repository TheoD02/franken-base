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
 * A StatisticalPopulation is a set of instances of a certain given type that satisfy some set of constraints. The property \[\[populationType\]\] is used to specify the type. Any property that can be used on instances of that type can appear on the statistical population. For example, a \[\[StatisticalPopulation\]\] representing all \[\[Person\]\]s with a \[\[homeLocation\]\] of East Podunk California would be described by applying the appropriate \[\[homeLocation\]\] and \[\[populationType\]\] properties to a \[\[StatisticalPopulation\]\] item that stands for that set of people. The properties \[\[numConstraints\]\] and \[\[constraintProperty\]\] are used to specify which of the populations properties are used to specify the population. Note that the sense of "population" used here is the general sense of a statistical population, and does not imply that the population consists of people. For example, a \[\[populationType\]\] of \[\[Event\]\] or \[\[NewsArticle\]\] could be used. See also \[\[Observation\]\], where a \[\[populationType\]\] such as \[\[Person\]\] or \[\[Event\]\] can be indicated directly. In most cases it may be better to use \[\[StatisticalVariable\]\] instead of \[\[StatisticalPopulation\]\].
 *
 * @see https://schema.org/StatisticalPopulation
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/StatisticalPopulation'])]
class StatisticalPopulation extends Intangible
{
	/**
	 * Indicates the populationType common to all members of a \[\[StatisticalPopulation\]\] or all cases within the scope of a \[\[StatisticalVariable\]\].
	 *
	 * @see https://schema.org/populationType
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Class_')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/populationType'])]
	#[Assert\NotNull]
	private Class_ $populationType;

	public function setPopulationType(Class_ $populationType): void
	{
		$this->populationType = $populationType;
	}

	public function getPopulationType(): Class_
	{
		return $this->populationType;
	}
}
