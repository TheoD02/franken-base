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
 * An list item, e.g. a step in a checklist or how-to description.
 *
 * @see https://schema.org/ListItem
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
	'listItem' => ListItem::class,
	'howToDirection' => HowToDirection::class,
	'howToSupply' => HowToSupply::class,
	'howToTool' => HowToTool::class,
])]
class ListItem extends Intangible
{
	/**
	 * A link to the ListItem that precedes the current one.
	 *
	 * @see https://schema.org/previousItem
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\ListItem')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/previousItem'])]
	#[Assert\NotNull]
	private ListItem $previousItem;

	/**
	 * The position of an item in a series or sequence of items.
	 *
	 * @see https://schema.org/position
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
	#[ApiProperty(types: ['https://schema.org/position'])]
	private ?int $position = null;

	/**
	 * A link to the ListItem that follows the current one.
	 *
	 * @see https://schema.org/nextItem
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\ListItem')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/nextItem'])]
	#[Assert\NotNull]
	private ListItem $nextItem;

	/**
	 * An entity represented by an entry in a list or data feed (e.g. an 'artist' in a list of 'artists').
	 *
	 * @see https://schema.org/item
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Thing')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/item'])]
	#[Assert\NotNull]
	private Thing $item;

	public function setPreviousItem(ListItem $previousItem): void
	{
		$this->previousItem = $previousItem;
	}

	public function getPreviousItem(): ListItem
	{
		return $this->previousItem;
	}

	public function setPosition(?int $position): void
	{
		$this->position = $position;
	}

	public function getPosition(): ?int
	{
		return $this->position;
	}

	public function setNextItem(ListItem $nextItem): void
	{
		$this->nextItem = $nextItem;
	}

	public function getNextItem(): ListItem
	{
		return $this->nextItem;
	}

	public function setItem(Thing $item): void
	{
		$this->item = $item;
	}

	public function getItem(): Thing
	{
		return $this->item;
	}
}
