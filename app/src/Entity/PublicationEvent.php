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
 * A PublicationEvent corresponds indifferently to the event of publication for a CreativeWork of any type, e.g. a broadcast event, an on-demand event, a book/journal publication via a variety of delivery media.
 *
 * @see https://schema.org/PublicationEvent
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
	'publicationEvent' => PublicationEvent::class,
	'onDemandEvent' => OnDemandEvent::class,
	'broadcastEvent' => BroadcastEvent::class,
])]
class PublicationEvent extends Event
{
	/**
	 * An agent associated with the publication event.
	 *
	 * @see https://schema.org/publishedBy
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/publishedBy'])]
	#[Assert\NotNull]
	private Organization $publishedBy;

	/**
	 * A broadcast service associated with the publication event.
	 *
	 * @see https://schema.org/publishedOn
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\BroadcastService')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/publishedOn'])]
	#[Assert\NotNull]
	private BroadcastService $publishedOn;

	public function setPublishedBy(Organization $publishedBy): void
	{
		$this->publishedBy = $publishedBy;
	}

	public function getPublishedBy(): Organization
	{
		return $this->publishedBy;
	}

	public function setPublishedOn(BroadcastService $publishedOn): void
	{
		$this->publishedOn = $publishedOn;
	}

	public function getPublishedOn(): BroadcastService
	{
		return $this->publishedOn;
	}
}
