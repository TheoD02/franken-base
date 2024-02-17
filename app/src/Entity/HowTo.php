<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Instructions that explain how to achieve a result by performing a sequence of steps.
 *
 * @see https://schema.org/HowTo
 */
#[ORM\MappedSuperclass]
abstract class HowTo extends CreativeWork
{
    /**
     * A single step item (as HowToStep, text, document, video, etc.) or a HowToSection.
     *
     * @see https://schema.org/step
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/step'])]
    private ?string $step = null;

    /**
     * The total time required to perform instructions or a direction (including time to prepare the supplies), in \[ISO 8601 duration format\](http://en.wikipedia.org/wiki/ISO\_8601).
     *
     * @see https://schema.org/totalTime
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Duration')]
    #[ApiProperty(types: ['https://schema.org/totalTime'])]
    private ?Duration $totalTime = null;

    /**
     * The estimated cost of the supply or supplies consumed when performing instructions.
     *
     * @see https://schema.org/estimatedCost
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MonetaryAmount')]
    #[ApiProperty(types: ['https://schema.org/estimatedCost'])]
    private ?MonetaryAmount $estimatedCost = null;

    /**
     * The quantity that results by performing instructions. For example, a paper airplane, 10 personalized candles.
     *
     * @see https://schema.org/yield
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/yield'])]
    private ?string $yield = null;

    /**
     * The length of time it takes to prepare the items to be used in instructions or a direction, in \[ISO 8601 duration format\](http://en.wikipedia.org/wiki/ISO\_8601).
     *
     * @see https://schema.org/prepTime
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Duration')]
    #[ApiProperty(types: ['https://schema.org/prepTime'])]
    private ?Duration $prepTime = null;

    /**
     * The length of time it takes to perform instructions or a direction (not including time to prepare the supplies), in \[ISO 8601 duration format\](http://en.wikipedia.org/wiki/ISO\_8601).
     *
     * @see https://schema.org/performTime
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Duration')]
    #[ApiProperty(types: ['https://schema.org/performTime'])]
    private ?Duration $performTime = null;

    /**
     * A sub-property of instrument. A supply consumed when performing instructions or a direction.
     *
     * @see https://schema.org/supply
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/supply'])]
    private ?string $supply = null;

    /**
     * A sub property of instrument. An object used (but not consumed) when performing instructions or a direction.
     *
     * @see https://schema.org/tool
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\HowToTool')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/tool'])]
    #[Assert\NotNull]
    private HowToTool $tool;

    public function setStep(?string $step): void
    {
        $this->step = $step;
    }

    public function getStep(): ?string
    {
        return $this->step;
    }

    public function setTotalTime(?Duration $totalTime): void
    {
        $this->totalTime = $totalTime;
    }

    public function getTotalTime(): ?Duration
    {
        return $this->totalTime;
    }

    public function setEstimatedCost(?MonetaryAmount $estimatedCost): void
    {
        $this->estimatedCost = $estimatedCost;
    }

    public function getEstimatedCost(): ?MonetaryAmount
    {
        return $this->estimatedCost;
    }

    public function setYield(?string $yield): void
    {
        $this->yield = $yield;
    }

    public function getYield(): ?string
    {
        return $this->yield;
    }

    public function setPrepTime(?Duration $prepTime): void
    {
        $this->prepTime = $prepTime;
    }

    public function getPrepTime(): ?Duration
    {
        return $this->prepTime;
    }

    public function setPerformTime(?Duration $performTime): void
    {
        $this->performTime = $performTime;
    }

    public function getPerformTime(): ?Duration
    {
        return $this->performTime;
    }

    public function setSupply(?string $supply): void
    {
        $this->supply = $supply;
    }

    public function getSupply(): ?string
    {
        return $this->supply;
    }

    public function setTool(HowToTool $tool): void
    {
        $this->tool = $tool;
    }

    public function getTool(): HowToTool
    {
        return $this->tool;
    }
}
