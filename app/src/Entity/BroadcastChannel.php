<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A unique instance of a BroadcastService on a CableOrSatelliteService lineup.
 *
 * @see https://schema.org/BroadcastChannel
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
    'broadcastChannel' => BroadcastChannel::class,
    'televisionChannel' => TelevisionChannel::class,
    'FMRadioChannel' => FMRadioChannel::class,
    'AMRadioChannel' => AMRadioChannel::class,
])]
class BroadcastChannel extends Intangible
{
    /**
     * Genre of the creative work, broadcast channel or group.
     *
     * @see https://schema.org/genre
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
    #[ApiProperty(types: ['https://schema.org/genre'])]
    #[Assert\Url]
    private ?string $genre = null;

    /**
     * The CableOrSatelliteService offering the channel.
     *
     * @see https://schema.org/inBroadcastLineup
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\CableOrSatelliteService')]
    #[ApiProperty(types: ['https://schema.org/inBroadcastLineup'])]
    private ?CableOrSatelliteService $inBroadcastLineup = null;

    /**
     * The frequency used for over-the-air broadcasts. Numeric values or simple ranges, e.g. 87-99. In addition a shortcut idiom is supported for frequences of AM and FM radio channels, e.g. "87 FM".
     *
     * @see https://schema.org/broadcastFrequency
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\BroadcastFrequencySpecification')]
    #[ApiProperty(types: ['https://schema.org/broadcastFrequency'])]
    private ?BroadcastFrequencySpecification $broadcastFrequency = null;

    /**
     * The type of service required to have access to the channel (e.g. Standard or Premium).
     *
     * @see https://schema.org/broadcastServiceTier
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/broadcastServiceTier'])]
    private ?string $broadcastServiceTier = null;

    /**
     * The unique address by which the BroadcastService can be identified in a provider lineup. In US, this is typically a number.
     *
     * @see https://schema.org/broadcastChannelId
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/broadcastChannelId'])]
    private ?string $broadcastChannelId = null;

    /**
     * The BroadcastService offered on this channel.
     *
     * @see https://schema.org/providesBroadcastService
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\BroadcastService')]
    #[ApiProperty(types: ['https://schema.org/providesBroadcastService'])]
    private ?BroadcastService $providesBroadcastService = null;

    public function setGenre(?string $genre): void
    {
        $this->genre = $genre;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setInBroadcastLineup(?CableOrSatelliteService $inBroadcastLineup): void
    {
        $this->inBroadcastLineup = $inBroadcastLineup;
    }

    public function getInBroadcastLineup(): ?CableOrSatelliteService
    {
        return $this->inBroadcastLineup;
    }

    public function setBroadcastFrequency(?BroadcastFrequencySpecification $broadcastFrequency): void
    {
        $this->broadcastFrequency = $broadcastFrequency;
    }

    public function getBroadcastFrequency(): ?BroadcastFrequencySpecification
    {
        return $this->broadcastFrequency;
    }

    public function setBroadcastServiceTier(?string $broadcastServiceTier): void
    {
        $this->broadcastServiceTier = $broadcastServiceTier;
    }

    public function getBroadcastServiceTier(): ?string
    {
        return $this->broadcastServiceTier;
    }

    public function setBroadcastChannelId(?string $broadcastChannelId): void
    {
        $this->broadcastChannelId = $broadcastChannelId;
    }

    public function getBroadcastChannelId(): ?string
    {
        return $this->broadcastChannelId;
    }

    public function setProvidesBroadcastService(?BroadcastService $providesBroadcastService): void
    {
        $this->providesBroadcastService = $providesBroadcastService;
    }

    public function getProvidesBroadcastService(): ?BroadcastService
    {
        return $this->providesBroadcastService;
    }
}
