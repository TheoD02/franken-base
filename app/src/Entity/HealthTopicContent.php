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
use App\Enum\HealthAspectEnumeration;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * \[\[HealthTopicContent\]\] is \[\[WebContent\]\] that is about some aspect of a health topic, e.g. a condition, its symptoms or treatments. Such content may be comprised of several parts or sections and use different types of media. Multiple instances of \[\[WebContent\]\] (and hence \[\[HealthTopicContent\]\]) can be related using \[\[hasPart\]\] / \[\[isPartOf\]\] where there is some kind of content hierarchy, and their content described with \[\[about\]\] and \[\[mentions\]\] e.g. building upon the existing \[\[MedicalCondition\]\] vocabulary.
 *
 * @see https://schema.org/HealthTopicContent
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/HealthTopicContent'])]
class HealthTopicContent extends WebContent
{
	/**
	 * Indicates the aspect or aspects specifically addressed in some \[\[HealthTopicContent\]\]. For example, that the content is an overview, or that it talks about treatment, self-care, treatments or their side-effects.
	 *
	 * @see https://schema.org/hasHealthAspect
	 */
	#[ORM\Column]
	#[ApiProperty(types: ['https://schema.org/hasHealthAspect'])]
	#[Assert\NotNull]
	#[Assert\Choice(callback: [HealthAspectEnumeration::class, 'toArray'])]
	private string $hasHealthAspect;

	public function setHasHealthAspect(string $hasHealthAspect): void
	{
		$this->hasHealthAspect = $hasHealthAspect;
	}

	public function getHasHealthAspect(): string
	{
		return $this->hasHealthAspect;
	}
}
