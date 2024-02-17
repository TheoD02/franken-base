<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Enum\MediaManipulationRatingEnumeration;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A \[\[MediaReview\]\] is a more specialized form of Review dedicated to the evaluation of media content online, typically in the context of fact-checking and misinformation. For more general reviews of media in the broader sense, use \[\[UserReview\]\], \[\[CriticReview\]\] or other \[\[Review\]\] types. This definition is a work in progress. While the \[\[MediaManipulationRatingEnumeration\]\] list reflects significant community review amongst fact-checkers and others working to combat misinformation, the specific structures for representing media objects, their versions and publication context, are still evolving. Similarly, best practices for the relationship between \[\[MediaReview\]\] and \[\[ClaimReview\]\] markup have not yet been finalized.
 *
 * @see https://schema.org/MediaReview
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MediaReview'])]
class MediaReview extends Review
{
    /**
     * Describes, in a \[\[MediaReview\]\] when dealing with \[\[DecontextualizedContent\]\], background information that can contribute to better interpretation of the \[\[MediaObject\]\].
     *
     * @see https://schema.org/originalMediaContextDescription
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/originalMediaContextDescription'])]
    private ?string $originalMediaContextDescription = null;

    /**
     * Link to the page containing an original version of the content, or directly to an online copy of the original \[\[MediaObject\]\] content, e.g. video file.
     *
     * @see https://schema.org/originalMediaLink
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
    #[ApiProperty(types: ['https://schema.org/originalMediaLink'])]
    #[Assert\Url]
    private ?string $originalMediaLink = null;

    /**
     * Indicates a MediaManipulationRatingEnumeration classification of a media object (in the context of how it was published or shared).
     *
     * @see https://schema.org/mediaAuthenticityCategory
     */
    #[ORM\Column]
    #[ApiProperty(types: ['https://schema.org/mediaAuthenticityCategory'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [MediaManipulationRatingEnumeration::class, 'toArray'])]
    private string $mediaAuthenticityCategory;

    public function setOriginalMediaContextDescription(?string $originalMediaContextDescription): void
    {
        $this->originalMediaContextDescription = $originalMediaContextDescription;
    }

    public function getOriginalMediaContextDescription(): ?string
    {
        return $this->originalMediaContextDescription;
    }

    public function setOriginalMediaLink(?string $originalMediaLink): void
    {
        $this->originalMediaLink = $originalMediaLink;
    }

    public function getOriginalMediaLink(): ?string
    {
        return $this->originalMediaLink;
    }

    public function setMediaAuthenticityCategory(string $mediaAuthenticityCategory): void
    {
        $this->mediaAuthenticityCategory = $mediaAuthenticityCategory;
    }

    public function getMediaAuthenticityCategory(): string
    {
        return $this->mediaAuthenticityCategory;
    }
}
