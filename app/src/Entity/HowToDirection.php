<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A direction indicating a single action to do in the instructions for how to achieve a result.
 *
 * @see https://schema.org/HowToDirection
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/HowToDirection'])]
class HowToDirection extends ListItem
{
    /**
     * A media object representing the circumstances before performing this direction.
     *
     * @see https://schema.org/beforeMedia
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MediaObject')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/beforeMedia'])]
    #[Assert\NotNull]
    private MediaObject $beforeMedia;

    /**
     * The total time required to perform instructions or a direction (including time to prepare the supplies), in \[ISO 8601 duration format\](http://en.wikipedia.org/wiki/ISO\_8601).
     *
     * @see https://schema.org/totalTime
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Duration')]
    #[ApiProperty(types: ['https://schema.org/totalTime'])]
    private ?Duration $totalTime = null;

    /**
     * A media object representing the circumstances while performing this direction.
     *
     * @see https://schema.org/duringMedia
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MediaObject')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/duringMedia'])]
    #[Assert\NotNull]
    private MediaObject $duringMedia;

    /**
     * A media object representing the circumstances after performing this direction.
     *
     * @see https://schema.org/afterMedia
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MediaObject')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/afterMedia'])]
    #[Assert\NotNull]
    private MediaObject $afterMedia;

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

    public function setBeforeMedia(MediaObject $beforeMedia): void
    {
        $this->beforeMedia = $beforeMedia;
    }

    public function getBeforeMedia(): MediaObject
    {
        return $this->beforeMedia;
    }

    public function setTotalTime(?Duration $totalTime): void
    {
        $this->totalTime = $totalTime;
    }

    public function getTotalTime(): ?Duration
    {
        return $this->totalTime;
    }

    public function setDuringMedia(MediaObject $duringMedia): void
    {
        $this->duringMedia = $duringMedia;
    }

    public function getDuringMedia(): MediaObject
    {
        return $this->duringMedia;
    }

    public function setAfterMedia(MediaObject $afterMedia): void
    {
        $this->afterMedia = $afterMedia;
    }

    public function getAfterMedia(): MediaObject
    {
        return $this->afterMedia;
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
