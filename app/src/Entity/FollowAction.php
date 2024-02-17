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
 * The act of forming a personal connection with someone/something (object) unidirectionally/asymmetrically to get updates polled from.\\n\\nRelated actions:\\n\\n\* \[\[BefriendAction\]\]: Unlike BefriendAction, FollowAction implies that the connection is \*not\* necessarily reciprocal.\\n\* \[\[SubscribeAction\]\]: Unlike SubscribeAction, FollowAction implies that the follower acts as an active agent constantly/actively polling for updates.\\n\* \[\[RegisterAction\]\]: Unlike RegisterAction, FollowAction implies that the agent is interested in continuing receiving updates from the object.\\n\* \[\[JoinAction\]\]: Unlike JoinAction, FollowAction implies that the agent is interested in getting updates from the object.\\n\* \[\[TrackAction\]\]: Unlike TrackAction, FollowAction refers to the polling of updates of all aspects of animate objects rather than the location of inanimate objects (e.g. you track a package, but you don't follow it).
 *
 * @see https://schema.org/FollowAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/FollowAction'])]
class FollowAction extends InteractAction
{
	/**
	 * A sub property of object. The person or organization being followed.
	 *
	 * @see https://schema.org/followee
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/followee'])]
	#[Assert\NotNull]
	private Person $followee;

	public function setFollowee(Person $followee): void
	{
		$this->followee = $followee;
	}

	public function getFollowee(): Person
	{
		return $this->followee;
	}
}
