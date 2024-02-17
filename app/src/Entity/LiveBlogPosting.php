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
 * A \[\[LiveBlogPosting\]\] is a \[\[BlogPosting\]\] intended to provide a rolling textual coverage of an ongoing event through continuous updates.
 *
 * @see https://schema.org/LiveBlogPosting
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/LiveBlogPosting'])]
class LiveBlogPosting extends BlogPosting
{
	/**
	 * The time when the live blog will stop covering the Event. Note that coverage may continue after the Event concludes.
	 *
	 * @see https://schema.org/coverageEndTime
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\DateTime')]
	#[ApiProperty(types: ['https://schema.org/coverageEndTime'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $coverageEndTime = null;

	/**
	 * The time when the live blog will begin covering the Event. Note that coverage may begin before the Event's start time. The LiveBlogPosting may also be created before coverage begins.
	 *
	 * @see https://schema.org/coverageStartTime
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\DateTime')]
	#[ApiProperty(types: ['https://schema.org/coverageStartTime'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $coverageStartTime = null;

	/**
	 * An update to the LiveBlog.
	 *
	 * @see https://schema.org/liveBlogUpdate
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\BlogPosting')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/liveBlogUpdate'])]
	#[Assert\NotNull]
	private BlogPosting $liveBlogUpdate;

	public function setCoverageEndTime(?\DateTimeInterface $coverageEndTime): void
	{
		$this->coverageEndTime = $coverageEndTime;
	}

	public function getCoverageEndTime(): ?\DateTimeInterface
	{
		return $this->coverageEndTime;
	}

	public function setCoverageStartTime(?\DateTimeInterface $coverageStartTime): void
	{
		$this->coverageStartTime = $coverageStartTime;
	}

	public function getCoverageStartTime(): ?\DateTimeInterface
	{
		return $this->coverageStartTime;
	}

	public function setLiveBlogUpdate(BlogPosting $liveBlogUpdate): void
	{
		$this->liveBlogUpdate = $liveBlogUpdate;
	}

	public function getLiveBlogUpdate(): BlogPosting
	{
		return $this->liveBlogUpdate;
	}
}
