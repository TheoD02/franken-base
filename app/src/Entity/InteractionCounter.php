<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A summary of how users have interacted with this CreativeWork. In most cases, authors will use a subtype to specify the specific type of interaction.
 *
 * @see https://schema.org/InteractionCounter
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/InteractionCounter'])]
class InteractionCounter extends StructuredValue
{
    /**
     * The location of, for example, where an event is happening, where an organization is located, or where an action takes place.
     *
     * @see https://schema.org/location
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\PostalAddress')]
    #[ApiProperty(types: ['https://schema.org/location'])]
    private ?PostalAddress $location = null;

    /**
     * The endTime of something. For a reserved event or service (e.g. FoodEstablishmentReservation), the time that it is expected to end. For actions that span a period of time, when the action was performed. E.g. John wrote a book from January to \*December\*. For media, including audio and video, it's the time offset of the end of a clip within a larger file.\\n\\nNote that Event uses startDate/endDate instead of startTime/endTime, even when describing dates with times. This situation may be clarified in future revisions.
     *
     * @see https://schema.org/endTime
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Time')]
    #[ApiProperty(types: ['https://schema.org/endTime'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $endTime = null;

    /**
     * The startTime of something. For a reserved event or service (e.g. FoodEstablishmentReservation), the time that it is expected to start. For actions that span a period of time, when the action was performed. E.g. John wrote a book from \*January\* to December. For media, including audio and video, it's the time offset of the start of a clip within a larger file.\\n\\nNote that Event uses startDate/endDate instead of startTime/endTime, even when describing dates with times. This situation may be clarified in future revisions.
     *
     * @see https://schema.org/startTime
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Time')]
    #[ApiProperty(types: ['https://schema.org/startTime'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $startTime = null;

    /**
     * The Action representing the type of interaction. For up votes, +1s, etc. use \[\[LikeAction\]\]. For down votes use \[\[DislikeAction\]\]. Otherwise, use the most specific Action.
     *
     * @see https://schema.org/interactionType
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Action')]
    #[ApiProperty(types: ['https://schema.org/interactionType'])]
    private ?Action $interactionType = null;

    /**
     * The number of interactions for the CreativeWork using the WebSite or SoftwareApplication.
     *
     * @see https://schema.org/userInteractionCount
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
    #[ApiProperty(types: ['https://schema.org/userInteractionCount'])]
    private ?int $userInteractionCount = null;

    /**
     * The WebSite or SoftwareApplication where the interactions took place.
     *
     * @see https://schema.org/interactionService
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\WebSite')]
    #[ApiProperty(types: ['https://schema.org/interactionService'])]
    private ?WebSite $interactionService = null;

    public function setLocation(?PostalAddress $location): void
    {
        $this->location = $location;
    }

    public function getLocation(): ?PostalAddress
    {
        return $this->location;
    }

    public function setEndTime(?\DateTimeInterface $endTime): void
    {
        $this->endTime = $endTime;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setStartTime(?\DateTimeInterface $startTime): void
    {
        $this->startTime = $startTime;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setInteractionType(?Action $interactionType): void
    {
        $this->interactionType = $interactionType;
    }

    public function getInteractionType(): ?Action
    {
        return $this->interactionType;
    }

    public function setUserInteractionCount(?int $userInteractionCount): void
    {
        $this->userInteractionCount = $userInteractionCount;
    }

    public function getUserInteractionCount(): ?int
    {
        return $this->userInteractionCount;
    }

    public function setInteractionService(?WebSite $interactionService): void
    {
        $this->interactionService = $interactionService;
    }

    public function getInteractionService(): ?WebSite
    {
        return $this->interactionService;
    }
}
