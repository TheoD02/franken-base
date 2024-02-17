<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The act of asking someone to attend an event. Reciprocal of RsvpAction.
 *
 * @see https://schema.org/InviteAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/InviteAction'])]
class InviteAction extends CommunicateAction
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

    public function setEvent(Event $event): void
    {
        $this->event = $event;
    }

    public function getEvent(): Event
    {
        return $this->event;
    }
}
