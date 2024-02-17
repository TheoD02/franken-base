<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\Post;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A post to a social media platform, including blog posts, tweets, Facebook posts, etc.
 *
 * @see https://schema.org/SocialMediaPosting
 */
#[ORM\MappedSuperclass]
abstract class SocialMediaPosting extends Article
{
    /**
     * A CreativeWork such as an image, video, or audio clip shared as part of this posting.
     *
     * @see https://schema.org/sharedContent
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWork')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/sharedContent'])]
    #[Assert\NotNull]
    private CreativeWork $sharedContent;

    public function setSharedContent(CreativeWork $sharedContent): void
    {
        $this->sharedContent = $sharedContent;
    }

    public function getSharedContent(): CreativeWork
    {
        return $this->sharedContent;
    }
}
