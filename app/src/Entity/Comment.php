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
 * A comment on an item - for example, a comment on a blog post. The comment's content is expressed via the \[\[text\]\] property, and its topic via \[\[about\]\], properties shared with all CreativeWorks.
 *
 * @see https://schema.org/Comment
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
	'comment' => Comment::class,
	'correctionComment' => CorrectionComment::class,
	'answer' => Answer::class,
	'question' => Question::class,
])]
#[ORM\Table(name: '`comment`')]
class Comment extends CreativeWork
{
	/**
	 * The number of upvotes this question, answer or comment has received from the community.
	 *
	 * @see https://schema.org/upvoteCount
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
	#[ApiProperty(types: ['https://schema.org/upvoteCount'])]
	private ?int $upvoteCount = null;

	/**
	 * A CreativeWork such as an image, video, or audio clip shared as part of this posting.
	 *
	 * @see https://schema.org/sharedContent
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWork')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/sharedContent'])]
	#[Assert\NotNull]
	private CreativeWork $sharedContent;

	/**
	 * The number of downvotes this question, answer or comment has received from the community.
	 *
	 * @see https://schema.org/downvoteCount
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
	#[ApiProperty(types: ['https://schema.org/downvoteCount'])]
	private ?int $downvoteCount = null;

	/**
	 * The parent of a question, answer or item in general. Typically used for Q/A discussion threads e.g. a chain of comments with the first comment being an \[\[Article\]\] or other \[\[CreativeWork\]\]. See also \[\[comment\]\] which points from something to a comment about it.
	 *
	 * @see https://schema.org/parentItem
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWork')]
	#[ApiProperty(types: ['https://schema.org/parentItem'])]
	private ?CreativeWork $parentItem = null;

	public function setUpvoteCount(?int $upvoteCount): void
	{
		$this->upvoteCount = $upvoteCount;
	}

	public function getUpvoteCount(): ?int
	{
		return $this->upvoteCount;
	}

	public function setSharedContent(CreativeWork $sharedContent): void
	{
		$this->sharedContent = $sharedContent;
	}

	public function getSharedContent(): CreativeWork
	{
		return $this->sharedContent;
	}

	public function setDownvoteCount(?int $downvoteCount): void
	{
		$this->downvoteCount = $downvoteCount;
	}

	public function getDownvoteCount(): ?int
	{
		return $this->downvoteCount;
	}

	public function setParentItem(?CreativeWork $parentItem): void
	{
		$this->parentItem = $parentItem;
	}

	public function getParentItem(): ?CreativeWork
	{
		return $this->parentItem;
	}
}
