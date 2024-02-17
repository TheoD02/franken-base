<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;

/**
 * A statistical distribution of values.
 *
 * @see https://schema.org/QuantitativeValueDistribution
 */
#[ORM\MappedSuperclass]
abstract class QuantitativeValueDistribution extends StructuredValue
{
    /**
     * The 10th percentile value.
     *
     * @see https://schema.org/percentile10
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/percentile10'])]
    private ?string $percentile10 = null;

    /**
     * The 75th percentile value.
     *
     * @see https://schema.org/percentile75
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/percentile75'])]
    private ?string $percentile75 = null;

    /**
     * The 25th percentile value.
     *
     * @see https://schema.org/percentile25
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/percentile25'])]
    private ?string $percentile25 = null;

    /**
     * The duration of the item (movie, audio recording, event, etc.) in \[ISO 8601 date format\](http://en.wikipedia.org/wiki/ISO\_8601).
     *
     * @see https://schema.org/duration
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Duration')]
    #[ApiProperty(types: ['https://schema.org/duration'])]
    private ?Duration $duration = null;

    /**
     * The 90th percentile value.
     *
     * @see https://schema.org/percentile90
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/percentile90'])]
    private ?string $percentile90 = null;

    /**
     * The median value.
     *
     * @see https://schema.org/median
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/median'])]
    private ?string $median = null;

    public function setPercentile10(?string $percentile10): void
    {
        $this->percentile10 = $percentile10;
    }

    public function getPercentile10(): ?string
    {
        return $this->percentile10;
    }

    public function setPercentile75(?string $percentile75): void
    {
        $this->percentile75 = $percentile75;
    }

    public function getPercentile75(): ?string
    {
        return $this->percentile75;
    }

    public function setPercentile25(?string $percentile25): void
    {
        $this->percentile25 = $percentile25;
    }

    public function getPercentile25(): ?string
    {
        return $this->percentile25;
    }

    public function setDuration(?Duration $duration): void
    {
        $this->duration = $duration;
    }

    public function getDuration(): ?Duration
    {
        return $this->duration;
    }

    public function setPercentile90(?string $percentile90): void
    {
        $this->percentile90 = $percentile90;
    }

    public function getPercentile90(): ?string
    {
        return $this->percentile90;
    }

    public function setMedian(?string $median): void
    {
        $this->median = $median;
    }

    public function getMedian(): ?string
    {
        return $this->median;
    }
}
