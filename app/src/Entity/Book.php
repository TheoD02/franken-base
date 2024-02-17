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
use App\Enum\BookFormatType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A book.
 *
 * @see https://schema.org/Book
 */
#[ORM\MappedSuperclass]
abstract class Book extends CreativeWork
{
	/**
	 * The number of pages in the book.
	 *
	 * @see https://schema.org/numberOfPages
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
	#[ApiProperty(types: ['https://schema.org/numberOfPages'])]
	private ?int $numberOfPages = null;

	/**
	 * The ISBN of the book.
	 *
	 * @see https://schema.org/isbn
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/isbn'])]
	private ?string $isbn = null;

	/**
	 * The format of the book.
	 *
	 * @see https://schema.org/bookFormat
	 */
	#[ORM\Column(nullable: true)]
	#[ApiProperty(types: ['https://schema.org/bookFormat'])]
	#[Assert\Choice(callback: [BookFormatType::class, 'toArray'])]
	private ?string $bookFormat = null;

	/**
	 * The edition of the book.
	 *
	 * @see https://schema.org/bookEdition
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/bookEdition'])]
	private ?string $bookEdition = null;

	/**
	 * The illustrator of the book.
	 *
	 * @see https://schema.org/illustrator
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ApiProperty(types: ['https://schema.org/illustrator'])]
	private ?Person $illustrator = null;

	/**
	 * Indicates whether the book is an abridged edition.
	 *
	 * @see https://schema.org/abridged
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Boolean')]
	#[ApiProperty(types: ['https://schema.org/abridged'])]
	private ?bool $abridged = null;

	public function setNumberOfPages(?int $numberOfPages): void
	{
		$this->numberOfPages = $numberOfPages;
	}

	public function getNumberOfPages(): ?int
	{
		return $this->numberOfPages;
	}

	public function setIsbn(?string $isbn): void
	{
		$this->isbn = $isbn;
	}

	public function getIsbn(): ?string
	{
		return $this->isbn;
	}

	public function setBookFormat(?string $bookFormat): void
	{
		$this->bookFormat = $bookFormat;
	}

	public function getBookFormat(): ?string
	{
		return $this->bookFormat;
	}

	public function setBookEdition(?string $bookEdition): void
	{
		$this->bookEdition = $bookEdition;
	}

	public function getBookEdition(): ?string
	{
		return $this->bookEdition;
	}

	public function setIllustrator(?Person $illustrator): void
	{
		$this->illustrator = $illustrator;
	}

	public function getIllustrator(): ?Person
	{
		return $this->illustrator;
	}

	public function setAbridged(?bool $abridged): void
	{
		$this->abridged = $abridged;
	}

	public function getAbridged(): ?bool
	{
		return $this->abridged;
	}
}
