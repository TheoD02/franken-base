<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Represents an item or group of closely related items treated as a unit for the sake of evaluation in a \[\[MediaReview\]\]. Authorship etc. apply to the items rather than to the curation/grouping or reviewing party.
 *
 * @see https://schema.org/MediaReviewItem
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MediaReviewItem'])]
class MediaReviewItem extends CreativeWork
{
    /**
     * @var Collection<MediaObject>|null in the context of a \[\[MediaReview\]\], indicates specific media item(s) that are grouped using a \[\[MediaReviewItem\]\]
     *
     * @see https://schema.org/mediaItemAppearance
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\MediaObject')]
    #[ORM\JoinTable(name: 'media_review_item_media_object_media_item_appearance')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/mediaItemAppearance'])]
    private ?Collection $mediaItemAppearance = null;

    public function __construct()
    {
        parent::__construct();
        $this->mediaItemAppearance = new ArrayCollection();
    }

    public function addMediaItemAppearance(MediaObject $mediaItemAppearance): void
    {
        $this->mediaItemAppearance[] = $mediaItemAppearance;
    }

    public function removeMediaItemAppearance(MediaObject $mediaItemAppearance): void
    {
        $this->mediaItemAppearance->removeElement($mediaItemAppearance);
    }

    /**
     * @return Collection<MediaObject>|null
     */
    public function getMediaItemAppearance(): Collection
    {
        return $this->mediaItemAppearance;
    }
}
