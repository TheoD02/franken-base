<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Enum\RsvpResponseType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The act of notifying an event organizer as to whether you expect to attend the event.
 *
 * @see https://schema.org/RsvpAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/RsvpAction'])]
class RsvpAction extends InformAction
{
    /**
     * If responding yes, the number of guests who will attend in addition to the invitee.
     *
     * @see https://schema.org/additionalNumberOfGuests
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/additionalNumberOfGuests'])]
    private ?string $additionalNumberOfGuests = null;

    /**
     * The response (yes, no, maybe) to the RSVP.
     *
     * @see https://schema.org/rsvpResponse
     */
    #[ORM\Column(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/rsvpResponse'])]
    #[Assert\Choice(callback: [RsvpResponseType::class, 'toArray'])]
    private ?string $rsvpResponse = null;

    /**
     * Comments, typically from users.
     *
     * @see https://schema.org/comment
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Comment')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/comment'])]
    #[Assert\NotNull]
    private Comment $comment;

    public function setAdditionalNumberOfGuests(?string $additionalNumberOfGuests): void
    {
        $this->additionalNumberOfGuests = $additionalNumberOfGuests;
    }

    public function getAdditionalNumberOfGuests(): ?string
    {
        return $this->additionalNumberOfGuests;
    }

    public function setRsvpResponse(?string $rsvpResponse): void
    {
        $this->rsvpResponse = $rsvpResponse;
    }

    public function getRsvpResponse(): ?string
    {
        return $this->rsvpResponse;
    }

    public function setComment(Comment $comment): void
    {
        $this->comment = $comment;
    }

    public function getComment(): Comment
    {
        return $this->comment;
    }
}
