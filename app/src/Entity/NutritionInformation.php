<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Nutritional information about the recipe.
 *
 * @see https://schema.org/NutritionInformation
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/NutritionInformation'])]
class NutritionInformation extends StructuredValue
{
    /**
     * The number of grams of trans fat.
     *
     * @see https://schema.org/transFatContent
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Mass')]
    #[ApiProperty(types: ['https://schema.org/transFatContent'])]
    private ?Mass $transFatContent = null;

    /**
     * The number of milligrams of sodium.
     *
     * @see https://schema.org/sodiumContent
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Mass')]
    #[ApiProperty(types: ['https://schema.org/sodiumContent'])]
    private ?Mass $sodiumContent = null;

    /**
     * The number of grams of saturated fat.
     *
     * @see https://schema.org/saturatedFatContent
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Mass')]
    #[ApiProperty(types: ['https://schema.org/saturatedFatContent'])]
    private ?Mass $saturatedFatContent = null;

    /**
     * The number of grams of protein.
     *
     * @see https://schema.org/proteinContent
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Mass')]
    #[ApiProperty(types: ['https://schema.org/proteinContent'])]
    private ?Mass $proteinContent = null;

    /**
     * The number of calories.
     *
     * @see https://schema.org/calories
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Energy')]
    #[ApiProperty(types: ['https://schema.org/calories'])]
    private ?Energy $calories = null;

    /**
     * The serving size, in terms of the number of volume or mass.
     *
     * @see https://schema.org/servingSize
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/servingSize'])]
    private ?string $servingSize = null;

    /**
     * The number of grams of unsaturated fat.
     *
     * @see https://schema.org/unsaturatedFatContent
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Mass')]
    #[ApiProperty(types: ['https://schema.org/unsaturatedFatContent'])]
    private ?Mass $unsaturatedFatContent = null;

    /**
     * The number of grams of fiber.
     *
     * @see https://schema.org/fiberContent
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Mass')]
    #[ApiProperty(types: ['https://schema.org/fiberContent'])]
    private ?Mass $fiberContent = null;

    /**
     * The number of grams of carbohydrates.
     *
     * @see https://schema.org/carbohydrateContent
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Mass')]
    #[ApiProperty(types: ['https://schema.org/carbohydrateContent'])]
    private ?Mass $carbohydrateContent = null;

    /**
     * The number of grams of fat.
     *
     * @see https://schema.org/fatContent
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Mass')]
    #[ApiProperty(types: ['https://schema.org/fatContent'])]
    private ?Mass $fatContent = null;

    /**
     * The number of grams of sugar.
     *
     * @see https://schema.org/sugarContent
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Mass')]
    #[ApiProperty(types: ['https://schema.org/sugarContent'])]
    private ?Mass $sugarContent = null;

    /**
     * The number of milligrams of cholesterol.
     *
     * @see https://schema.org/cholesterolContent
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Mass')]
    #[ApiProperty(types: ['https://schema.org/cholesterolContent'])]
    private ?Mass $cholesterolContent = null;

    public function setTransFatContent(?Mass $transFatContent): void
    {
        $this->transFatContent = $transFatContent;
    }

    public function getTransFatContent(): ?Mass
    {
        return $this->transFatContent;
    }

    public function setSodiumContent(?Mass $sodiumContent): void
    {
        $this->sodiumContent = $sodiumContent;
    }

    public function getSodiumContent(): ?Mass
    {
        return $this->sodiumContent;
    }

    public function setSaturatedFatContent(?Mass $saturatedFatContent): void
    {
        $this->saturatedFatContent = $saturatedFatContent;
    }

    public function getSaturatedFatContent(): ?Mass
    {
        return $this->saturatedFatContent;
    }

    public function setProteinContent(?Mass $proteinContent): void
    {
        $this->proteinContent = $proteinContent;
    }

    public function getProteinContent(): ?Mass
    {
        return $this->proteinContent;
    }

    public function setCalories(?Energy $calories): void
    {
        $this->calories = $calories;
    }

    public function getCalories(): ?Energy
    {
        return $this->calories;
    }

    public function setServingSize(?string $servingSize): void
    {
        $this->servingSize = $servingSize;
    }

    public function getServingSize(): ?string
    {
        return $this->servingSize;
    }

    public function setUnsaturatedFatContent(?Mass $unsaturatedFatContent): void
    {
        $this->unsaturatedFatContent = $unsaturatedFatContent;
    }

    public function getUnsaturatedFatContent(): ?Mass
    {
        return $this->unsaturatedFatContent;
    }

    public function setFiberContent(?Mass $fiberContent): void
    {
        $this->fiberContent = $fiberContent;
    }

    public function getFiberContent(): ?Mass
    {
        return $this->fiberContent;
    }

    public function setCarbohydrateContent(?Mass $carbohydrateContent): void
    {
        $this->carbohydrateContent = $carbohydrateContent;
    }

    public function getCarbohydrateContent(): ?Mass
    {
        return $this->carbohydrateContent;
    }

    public function setFatContent(?Mass $fatContent): void
    {
        $this->fatContent = $fatContent;
    }

    public function getFatContent(): ?Mass
    {
        return $this->fatContent;
    }

    public function setSugarContent(?Mass $sugarContent): void
    {
        $this->sugarContent = $sugarContent;
    }

    public function getSugarContent(): ?Mass
    {
        return $this->sugarContent;
    }

    public function setCholesterolContent(?Mass $cholesterolContent): void
    {
        $this->cholesterolContent = $cholesterolContent;
    }

    public function getCholesterolContent(): ?Mass
    {
        return $this->cholesterolContent;
    }
}
