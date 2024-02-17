<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A HyperToEntry is an item within a \[\[HyperToc\]\], which represents a hypertext table of contents for complex media objects, such as \[\[VideoObject\]\], \[\[AudioObject\]\]. The media object itself is indicated using \[\[associatedMedia\]\]. Each section of interest within that content can be described with a \[\[HyperTocEntry\]\], with associated \[\[startOffset\]\] and \[\[endOffset\]\]. When several entries are all from the same file, \[\[associatedMedia\]\] is used on the overarching \[\[HyperTocEntry\]\]; if the content has been split into multiple files, they can be referenced using \[\[associatedMedia\]\] on each \[\[HyperTocEntry\]\].
 *
 * @see https://schema.org/HyperTocEntry
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/HyperTocEntry'])]
class HyperTocEntry extends CreativeWork
{
    /**
     * Text of an utterances (spoken words, lyrics etc.) that occurs at a certain section of a media object, represented as a \[\[HyperTocEntry\]\].
     *
     * @see https://schema.org/utterances
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/utterances'])]
    private ?string $utterances = null;

    /**
     * A \[\[HyperTocEntry\]\] can have a \[\[tocContinuation\]\] indicated, which is another \[\[HyperTocEntry\]\] that would be the default next item to play or render.
     *
     * @see https://schema.org/tocContinuation
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\HyperTocEntry')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/tocContinuation'])]
    #[Assert\NotNull]
    private HyperTocEntry $tocContinuation;

    public function setUtterances(?string $utterances): void
    {
        $this->utterances = $utterances;
    }

    public function getUtterances(): ?string
    {
        return $this->utterances;
    }

    public function setTocContinuation(HyperTocEntry $tocContinuation): void
    {
        $this->tocContinuation = $tocContinuation;
    }

    public function getTocContinuation(): HyperTocEntry
    {
        return $this->tocContinuation;
    }
}
