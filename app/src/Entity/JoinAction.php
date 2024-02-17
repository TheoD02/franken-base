<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An agent joins an event/group with participants/friends at a location.\\n\\nRelated actions:\\n\\n\* \[\[RegisterAction\]\]: Unlike RegisterAction, JoinAction refers to joining a group/team of people.\\n\* \[\[SubscribeAction\]\]: Unlike SubscribeAction, JoinAction does not imply that you'll be receiving updates.\\n\* \[\[FollowAction\]\]: Unlike FollowAction, JoinAction does not imply that you'll be polling for updates.
 *
 * @see https://schema.org/JoinAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/JoinAction'])]
class JoinAction extends InteractAction
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
