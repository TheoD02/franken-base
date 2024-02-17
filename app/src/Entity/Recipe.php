<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Enum\RestrictedDiet;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A recipe. For dietary restrictions covered by the recipe, a few common restrictions are enumerated via \[\[suitableForDiet\]\]. The \[\[keywords\]\] property can also be used to add more detail.
 *
 * @see https://schema.org/Recipe
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Recipe'])]
class Recipe extends HowTo
{
    /**
     * A step in making the recipe, in the form of a single item (document, video, etc.) or an ordered list with HowToStep and/or HowToSection items.
     *
     * @see https://schema.org/recipeInstructions
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\ItemList')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/recipeInstructions'])]
    #[Assert\NotNull]
    private ItemList $recipeInstructions;

    /**
     * Indicates a dietary restriction or guideline for which this recipe or menu item is suitable, e.g. diabetic, halal etc.
     *
     * @see https://schema.org/suitableForDiet
     */
    #[ORM\Column]
    #[ApiProperty(types: ['https://schema.org/suitableForDiet'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [RestrictedDiet::class, 'toArray'])]
    private string $suitableForDiet;

    /**
     * The category of the recipe—for example, appetizer, entree, etc.
     *
     * @see https://schema.org/recipeCategory
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/recipeCategory'])]
    private ?string $recipeCategory = null;

    /**
     * Nutrition information about the recipe or menu item.
     *
     * @see https://schema.org/nutrition
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\NutritionInformation')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/nutrition'])]
    #[Assert\NotNull]
    private NutritionInformation $nutrition;

    /**
     * The quantity produced by the recipe (for example, number of people served, number of servings, etc).
     *
     * @see https://schema.org/recipeYield
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ApiProperty(types: ['https://schema.org/recipeYield'])]
    private ?QuantitativeValue $recipeYield = null;

    /**
     * The method of cooking, such as Frying, Steaming, ...
     *
     * @see https://schema.org/cookingMethod
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/cookingMethod'])]
    private ?string $cookingMethod = null;

    /**
     * The cuisine of the recipe (for example, French or Ethiopian).
     *
     * @see https://schema.org/recipeCuisine
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/recipeCuisine'])]
    private ?string $recipeCuisine = null;

    /**
     * The time it takes to actually cook the dish, in \[ISO 8601 duration format\](http://en.wikipedia.org/wiki/ISO\_8601).
     *
     * @see https://schema.org/cookTime
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Duration')]
    #[ApiProperty(types: ['https://schema.org/cookTime'])]
    private ?Duration $cookTime = null;

    /**
     * A single ingredient used in the recipe, e.g. sugar, flour or garlic.
     *
     * @see https://schema.org/recipeIngredient
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/recipeIngredient'])]
    private ?string $recipeIngredient = null;

    public function setRecipeInstructions(ItemList $recipeInstructions): void
    {
        $this->recipeInstructions = $recipeInstructions;
    }

    public function getRecipeInstructions(): ItemList
    {
        return $this->recipeInstructions;
    }

    public function setSuitableForDiet(string $suitableForDiet): void
    {
        $this->suitableForDiet = $suitableForDiet;
    }

    public function getSuitableForDiet(): string
    {
        return $this->suitableForDiet;
    }

    public function setRecipeCategory(?string $recipeCategory): void
    {
        $this->recipeCategory = $recipeCategory;
    }

    public function getRecipeCategory(): ?string
    {
        return $this->recipeCategory;
    }

    public function setNutrition(NutritionInformation $nutrition): void
    {
        $this->nutrition = $nutrition;
    }

    public function getNutrition(): NutritionInformation
    {
        return $this->nutrition;
    }

    public function setRecipeYield(?QuantitativeValue $recipeYield): void
    {
        $this->recipeYield = $recipeYield;
    }

    public function getRecipeYield(): ?QuantitativeValue
    {
        return $this->recipeYield;
    }

    public function setCookingMethod(?string $cookingMethod): void
    {
        $this->cookingMethod = $cookingMethod;
    }

    public function getCookingMethod(): ?string
    {
        return $this->cookingMethod;
    }

    public function setRecipeCuisine(?string $recipeCuisine): void
    {
        $this->recipeCuisine = $recipeCuisine;
    }

    public function getRecipeCuisine(): ?string
    {
        return $this->recipeCuisine;
    }

    public function setCookTime(?Duration $cookTime): void
    {
        $this->cookTime = $cookTime;
    }

    public function getCookTime(): ?Duration
    {
        return $this->cookTime;
    }

    public function setRecipeIngredient(?string $recipeIngredient): void
    {
        $this->recipeIngredient = $recipeIngredient;
    }

    public function getRecipeIngredient(): ?string
    {
        return $this->recipeIngredient;
    }
}
