<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A video file.
 *
 * @see https://schema.org/VideoObject
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap(['videoObject' => VideoObject::class, 'videoObjectSnapshot' => VideoObjectSnapshot::class])]
class VideoObject extends MediaObject
{
    /**
     * An actor, e.g. in TV, radio, movie, video games etc., or in an event. Actors can be associated with individual items or with a series, episode, clip.
     *
     * @see https://schema.org/actor
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/actor'])]
    #[Assert\NotNull]
    private Person $actor;

    /**
     * The frame size of the video.
     *
     * @see https://schema.org/videoFrameSize
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/videoFrameSize'])]
    private ?string $videoFrameSize = null;

    /**
     * Represents textual captioning from a \[\[MediaObject\]\], e.g. text of a 'meme'.
     *
     * @see https://schema.org/embeddedTextCaption
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/embeddedTextCaption'])]
    private ?string $embeddedTextCaption = null;

    /**
     * The caption for this object. For downloadable machine formats (closed caption, subtitles etc.) use MediaObject and indicate the \[\[encodingFormat\]\].
     *
     * @see https://schema.org/caption
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/caption'])]
    private ?string $caption = null;

    /**
     * A director of e.g. TV, radio, movie, video gaming etc. content, or of an event. Directors can be associated with individual items or with a series, episode, clip.
     *
     * @see https://schema.org/director
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/director'])]
    #[Assert\NotNull]
    private Person $director;

    /**
     * The composer of the soundtrack.
     *
     * @see https://schema.org/musicBy
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ApiProperty(types: ['https://schema.org/musicBy'])]
    private ?Person $musicBy = null;

    /**
     * The quality of the video.
     *
     * @see https://schema.org/videoQuality
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/videoQuality'])]
    private ?string $videoQuality = null;

    /**
     * If this MediaObject is an AudioObject or VideoObject, the transcript of that object.
     *
     * @see https://schema.org/transcript
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/transcript'])]
    private ?string $transcript = null;

    public function setActor(Person $actor): void
    {
        $this->actor = $actor;
    }

    public function getActor(): Person
    {
        return $this->actor;
    }

    public function setVideoFrameSize(?string $videoFrameSize): void
    {
        $this->videoFrameSize = $videoFrameSize;
    }

    public function getVideoFrameSize(): ?string
    {
        return $this->videoFrameSize;
    }

    public function setEmbeddedTextCaption(?string $embeddedTextCaption): void
    {
        $this->embeddedTextCaption = $embeddedTextCaption;
    }

    public function getEmbeddedTextCaption(): ?string
    {
        return $this->embeddedTextCaption;
    }

    public function setCaption(?string $caption): void
    {
        $this->caption = $caption;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setDirector(Person $director): void
    {
        $this->director = $director;
    }

    public function getDirector(): Person
    {
        return $this->director;
    }

    public function setMusicBy(?Person $musicBy): void
    {
        $this->musicBy = $musicBy;
    }

    public function getMusicBy(): ?Person
    {
        return $this->musicBy;
    }

    public function setVideoQuality(?string $videoQuality): void
    {
        $this->videoQuality = $videoQuality;
    }

    public function getVideoQuality(): ?string
    {
        return $this->videoQuality;
    }

    public function setTranscript(?string $transcript): void
    {
        $this->transcript = $transcript;
    }

    public function getTranscript(): ?string
    {
        return $this->transcript;
    }
}
