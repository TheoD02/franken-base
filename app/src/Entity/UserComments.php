<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * UserInteraction and its subtypes is an old way of talking about users interacting with pages. It is generally better to use \[\[Action\]\]-based vocabulary, alongside types such as \[\[Comment\]\].
 *
 * @see https://schema.org/UserComments
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/UserComments'])]
class UserComments extends UserInteraction
{
    /**
     * The text of the UserComment.
     *
     * @see https://schema.org/commentText
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/commentText'])]
    private ?string $commentText = null;

    /**
     * The time at which the UserComment was made.
     *
     * @see https://schema.org/commentTime
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/commentTime'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $commentTime = null;

    /**
     * The URL at which a reply may be posted to the specified UserComment.
     *
     * @see https://schema.org/replyToUrl
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\URL')]
    #[ApiProperty(types: ['https://schema.org/replyToUrl'])]
    #[Assert\Url]
    private ?string $replyToUrl = null;

    /**
     * The creator/author of this CreativeWork. This is the same as the Author property for CreativeWork.
     *
     * @see https://schema.org/creator
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
    #[ApiProperty(types: ['https://schema.org/creator'])]
    private ?Organization $creator = null;

    /**
     * Specifies the CreativeWork associated with the UserComment.
     *
     * @see https://schema.org/discusses
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWork')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/discusses'])]
    #[Assert\NotNull]
    private CreativeWork $discusses;

    public function setCommentText(?string $commentText): void
    {
        $this->commentText = $commentText;
    }

    public function getCommentText(): ?string
    {
        return $this->commentText;
    }

    public function setCommentTime(?\DateTimeInterface $commentTime): void
    {
        $this->commentTime = $commentTime;
    }

    public function getCommentTime(): ?\DateTimeInterface
    {
        return $this->commentTime;
    }

    public function setReplyToUrl(?string $replyToUrl): void
    {
        $this->replyToUrl = $replyToUrl;
    }

    public function getReplyToUrl(): ?string
    {
        return $this->replyToUrl;
    }

    public function setCreator(?Organization $creator): void
    {
        $this->creator = $creator;
    }

    public function getCreator(): ?Organization
    {
        return $this->creator;
    }

    public function setDiscusses(CreativeWork $discusses): void
    {
        $this->discusses = $discusses;
    }

    public function getDiscusses(): CreativeWork
    {
        return $this->discusses;
    }
}
