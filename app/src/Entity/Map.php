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
use App\Enum\MapCategoryType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A map.
 *
 * @see https://schema.org/Map
 */
#[ORM\Entity]
#[ORM\Table(name: '`map`')]
#[ApiResource(types: ['https://schema.org/Map'])]
class Map extends CreativeWork
{
	/**
	 * Indicates the kind of Map, from the MapCategoryType Enumeration.
	 *
	 * @see https://schema.org/mapType
	 */
	#[ORM\Column]
	#[ApiProperty(types: ['https://schema.org/mapType'])]
	#[Assert\NotNull]
	#[Assert\Choice(callback: [MapCategoryType::class, 'toArray'])]
	private string $mapType;

	public function setMapType(string $mapType): void
	{
		$this->mapType = $mapType;
	}

	public function getMapType(): string
	{
		return $this->mapType;
	}
}
