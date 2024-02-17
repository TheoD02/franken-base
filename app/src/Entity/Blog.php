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
 * A \[blog\](https://en.wikipedia.org/wiki/Blog), sometimes known as a "weblog". Note that the individual posts (\[\[BlogPosting\]\]s) in a \[\[Blog\]\] are often colloquially referred to by the same term.
 *
 * @see https://schema.org/Blog
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Blog'])]
class Blog extends CreativeWork
{
	/**
	 * The International Standard Serial Number (ISSN) that identifies this serial publication. You can repeat this property to identify different formats of, or the linking ISSN (ISSN-L) for, this serial publication.
	 *
	 * @see https://schema.org/issn
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/issn'])]
	private ?string $issn = null;

	/**
	 * A posting that is part of this blog.
	 *
	 * @see https://schema.org/blogPost
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\BlogPosting')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/blogPost'])]
	#[Assert\NotNull]
	private BlogPosting $blogPost;

	public function setIssn(?string $issn): void
	{
		$this->issn = $issn;
	}

	public function getIssn(): ?string
	{
		return $this->issn;
	}

	public function setBlogPost(BlogPosting $blogPost): void
	{
		$this->blogPost = $blogPost;
	}

	public function getBlogPost(): BlogPosting
	{
		return $this->blogPost;
	}
}
