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
 * A single feed providing structured information about one or more entities or topics.
 *
 * @see https://schema.org/DataFeed
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap(['dataFeed' => DataFeed::class, 'completeDataFeed' => CompleteDataFeed::class])]
class DataFeed extends Dataset
{
	/**
	 * An item within a data feed. Data feeds may have many elements.
	 *
	 * @see https://schema.org/dataFeedElement
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/dataFeedElement'])]
	private ?string $dataFeedElement = null;

	public function setDataFeedElement(?string $dataFeedElement): void
	{
		$this->dataFeedElement = $dataFeedElement;
	}

	public function getDataFeedElement(): ?string
	{
		return $this->dataFeedElement;
	}
}
