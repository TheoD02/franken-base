<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An agent leaves an event / group with participants/friends at a location.\\n\\nRelated actions:\\n\\n\* \[\[JoinAction\]\]: The antonym of LeaveAction.\\n\* \[\[UnRegisterAction\]\]: Unlike UnRegisterAction, LeaveAction implies leaving a group/team of people rather than a service.
 *
 * @see https://schema.org/LeaveAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/LeaveAction'])]
class LeaveAction extends InteractAction
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
