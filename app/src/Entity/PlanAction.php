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
 * The act of planning the execution of an event/task/action/reservation/plan to a future date.
 *
 * @see https://schema.org/PlanAction
 */
#[ORM\MappedSuperclass]
abstract class PlanAction extends OrganizeAction
{
	/**
	 * The time the object is scheduled to.
	 *
	 * @see https://schema.org/scheduledTime
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\DateTime')]
	#[ApiProperty(types: ['https://schema.org/scheduledTime'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $scheduledTime = null;

	public function setScheduledTime(?\DateTimeInterface $scheduledTime): void
	{
		$this->scheduledTime = $scheduledTime;
	}

	public function getScheduledTime(): ?\DateTimeInterface
	{
		return $this->scheduledTime;
	}
}
