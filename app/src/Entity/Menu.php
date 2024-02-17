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
 * A structured representation of food or drink items available from a FoodEstablishment.
 *
 * @see https://schema.org/Menu
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Menu'])]
class Menu extends CreativeWork
{
	/**
	 * A subgrouping of the menu (by dishes, course, serving time period, etc.).
	 *
	 * @see https://schema.org/hasMenuSection
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MenuSection')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/hasMenuSection'])]
	#[Assert\NotNull]
	private MenuSection $hasMenuSection;

	/**
	 * A food or drink item contained in a menu or menu section.
	 *
	 * @see https://schema.org/hasMenuItem
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MenuItem')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/hasMenuItem'])]
	#[Assert\NotNull]
	private MenuItem $hasMenuItem;

	public function setHasMenuSection(MenuSection $hasMenuSection): void
	{
		$this->hasMenuSection = $hasMenuSection;
	}

	public function getHasMenuSection(): MenuSection
	{
		return $this->hasMenuSection;
	}

	public function setHasMenuItem(MenuItem $hasMenuItem): void
	{
		$this->hasMenuItem = $hasMenuItem;
	}

	public function getHasMenuItem(): MenuItem
	{
		return $this->hasMenuItem;
	}
}
