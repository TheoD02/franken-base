<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A musical composition.
 *
 * @see https://schema.org/MusicComposition
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MusicComposition'])]
class MusicComposition extends CreativeWork
{
    /**
     * The type of composition (e.g. overture, sonata, symphony, etc.).
     *
     * @see https://schema.org/musicCompositionForm
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/musicCompositionForm'])]
    private ?string $musicCompositionForm = null;

    /**
     * The words in the song.
     *
     * @see https://schema.org/lyrics
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWork')]
    #[ApiProperty(types: ['https://schema.org/lyrics'])]
    private ?CreativeWork $lyrics = null;

    /**
     * An arrangement derived from the composition.
     *
     * @see https://schema.org/musicArrangement
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MusicComposition')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/musicArrangement'])]
    #[Assert\NotNull]
    private MusicComposition $musicArrangement;

    /**
     * Smaller compositions included in this work (e.g. a movement in a symphony).
     *
     * @see https://schema.org/includedComposition
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MusicComposition')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/includedComposition'])]
    #[Assert\NotNull]
    private MusicComposition $includedComposition;

    /**
     * The person or organization who wrote a composition, or who is the composer of a work performed at some event.
     *
     * @see https://schema.org/composer
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ApiProperty(types: ['https://schema.org/composer'])]
    private ?Person $composer = null;

    /**
     * The key, mode, or scale this composition uses.
     *
     * @see https://schema.org/musicalKey
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/musicalKey'])]
    private ?string $musicalKey = null;

    /**
     * The person who wrote the words.
     *
     * @see https://schema.org/lyricist
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ApiProperty(types: ['https://schema.org/lyricist'])]
    private ?Person $lyricist = null;

    /**
     * The date and place the work was first performed.
     *
     * @see https://schema.org/firstPerformance
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Event')]
    #[ApiProperty(types: ['https://schema.org/firstPerformance'])]
    private ?Event $firstPerformance = null;

    /**
     * The International Standard Musical Work Code for the composition.
     *
     * @see https://schema.org/iswcCode
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/iswcCode'])]
    private ?string $iswcCode = null;

    /**
     * An audio recording of the work.
     *
     * @see https://schema.org/recordedAs
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MusicRecording')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/recordedAs'])]
    #[Assert\NotNull]
    private MusicRecording $recordedAs;

    public function setMusicCompositionForm(?string $musicCompositionForm): void
    {
        $this->musicCompositionForm = $musicCompositionForm;
    }

    public function getMusicCompositionForm(): ?string
    {
        return $this->musicCompositionForm;
    }

    public function setLyrics(?CreativeWork $lyrics): void
    {
        $this->lyrics = $lyrics;
    }

    public function getLyrics(): ?CreativeWork
    {
        return $this->lyrics;
    }

    public function setMusicArrangement(MusicComposition $musicArrangement): void
    {
        $this->musicArrangement = $musicArrangement;
    }

    public function getMusicArrangement(): MusicComposition
    {
        return $this->musicArrangement;
    }

    public function setIncludedComposition(MusicComposition $includedComposition): void
    {
        $this->includedComposition = $includedComposition;
    }

    public function getIncludedComposition(): MusicComposition
    {
        return $this->includedComposition;
    }

    public function setComposer(?Person $composer): void
    {
        $this->composer = $composer;
    }

    public function getComposer(): ?Person
    {
        return $this->composer;
    }

    public function setMusicalKey(?string $musicalKey): void
    {
        $this->musicalKey = $musicalKey;
    }

    public function getMusicalKey(): ?string
    {
        return $this->musicalKey;
    }

    public function setLyricist(?Person $lyricist): void
    {
        $this->lyricist = $lyricist;
    }

    public function getLyricist(): ?Person
    {
        return $this->lyricist;
    }

    public function setFirstPerformance(?Event $firstPerformance): void
    {
        $this->firstPerformance = $firstPerformance;
    }

    public function getFirstPerformance(): ?Event
    {
        return $this->firstPerformance;
    }

    public function setIswcCode(?string $iswcCode): void
    {
        $this->iswcCode = $iswcCode;
    }

    public function getIswcCode(): ?string
    {
        return $this->iswcCode;
    }

    public function setRecordedAs(MusicRecording $recordedAs): void
    {
        $this->recordedAs = $recordedAs;
    }

    public function getRecordedAs(): MusicRecording
    {
        return $this->recordedAs;
    }
}
