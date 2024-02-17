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
 * The act of producing/preparing food.
 *
 * @see https://schema.org/CookAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/CookAction'])]
class CookAction extends CreateAction
{
	/**
	 * A sub property of instrument. The recipe/instructions used to perform the action.
	 *
	 * @see https://schema.org/recipe
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Recipe')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/recipe'])]
	#[Assert\NotNull]
	private Recipe $recipe;

	/**
	 * A sub property of location. The specific food establishment where the action occurred.
	 *
	 * @see https://schema.org/foodEstablishment
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\FoodEstablishment')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/foodEstablishment'])]
	#[Assert\NotNull]
	private FoodEstablishment $foodEstablishment;

	/**
	 * A sub property of location. The specific food event where the action occurred.
	 *
	 * @see https://schema.org/foodEvent
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\FoodEvent')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/foodEvent'])]
	#[Assert\NotNull]
	private FoodEvent $foodEvent;

	public function setRecipe(Recipe $recipe): void
	{
		$this->recipe = $recipe;
	}

	public function getRecipe(): Recipe
	{
		return $this->recipe;
	}

	public function setFoodEstablishment(FoodEstablishment $foodEstablishment): void
	{
		$this->foodEstablishment = $foodEstablishment;
	}

	public function getFoodEstablishment(): FoodEstablishment
	{
		return $this->foodEstablishment;
	}

	public function setFoodEvent(FoodEvent $foodEvent): void
	{
		$this->foodEvent = $foodEvent;
	}

	public function getFoodEvent(): FoodEvent
	{
		return $this->foodEvent;
	}
}
