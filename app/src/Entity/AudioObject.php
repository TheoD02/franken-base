<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;

/**
 * An audio file.
 *
 * @see https://schema.org/AudioObject
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap(['audioObject' => AudioObject::class, 'audioObjectSnapshot' => AudioObjectSnapshot::class])]
class AudioObject extends MediaObject
{
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
     * If this MediaObject is an AudioObject or VideoObject, the transcript of that object.
     *
     * @see https://schema.org/transcript
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/transcript'])]
    private ?string $transcript = null;

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

    public function setTranscript(?string $transcript): void
    {
        $this->transcript = $transcript;
    }

    public function getTranscript(): ?string
    {
        return $this->transcript;
    }
}
