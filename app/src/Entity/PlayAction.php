<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The act of playing/exercising/training/performing for enjoyment, leisure, recreation, competition or exercise.\\n\\nRelated actions:\\n\\n\* \[\[ListenAction\]\]: Unlike ListenAction (which is under ConsumeAction), PlayAction refers to performing for an audience or at an event, rather than consuming music.\\n\* \[\[WatchAction\]\]: Unlike WatchAction (which is under ConsumeAction), PlayAction refers to showing/displaying for an audience or at an event, rather than consuming visual content.
 *
 * @see https://schema.org/PlayAction
 */
#[ORM\MappedSuperclass]
abstract class PlayAction extends Action
{
    /**
     * Upcoming or past event associated with this place, organization, or action.
     *
     * @see https://schema.org/event
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Event')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/event'])]
    #[Assert\NotNull]
    private Event $event;

    /**
     * An intended audience, i.e. a group for whom something was created.
     *
     * @see https://schema.org/audience
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Audience')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/audience'])]
    #[Assert\NotNull]
    private Audience $audience;

    public function setEvent(Event $event): void
    {
        $this->event = $event;
    }

    public function getEvent(): Event
    {
        return $this->event;
    }

    public function setAudience(Audience $audience): void
    {
        $this->audience = $audience;
    }

    public function getAudience(): Audience
    {
        return $this->audience;
    }
}
