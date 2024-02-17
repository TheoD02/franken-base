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
 * An image file.
 *
 * @see https://schema.org/ImageObject
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap(['imageObject' => ImageObject::class, 'barcode' => Barcode::class, 'imageObjectSnapshot' => ImageObjectSnapshot::class])]
class ImageObject extends MediaObject
{
	/**
	 * Represents textual captioning from a \[\[MediaObject\]\], e.g. text of a 'meme'.
	 *
	 * @see https://schema.org/embeddedTextCaption
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/embeddedTextCaption'])]
	private ?string $embeddedTextCaption = null;

	/**
	 * The caption for this object. For downloadable machine formats (closed caption, subtitles etc.) use MediaObject and indicate the \[\[encodingFormat\]\].
	 *
	 * @see https://schema.org/caption
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/caption'])]
	private ?string $caption = null;

	/**
	 * exif data for this object.
	 *
	 * @see https://schema.org/exifData
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\PropertyValue')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/exifData'])]
	#[Assert\NotNull]
	private PropertyValue $exifData;

	/**
	 * Indicates whether this image is representative of the content of the page.
	 *
	 * @see https://schema.org/representativeOfPage
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Boolean')]
	#[ApiProperty(types: ['https://schema.org/representativeOfPage'])]
	private ?bool $representativeOfPage = null;

	public function setEmbeddedTextCaption(?string $embeddedTextCaption): void
	{
		$this->embeddedTextCaption = $embeddedTextCaption;
	}

	public function getEmbeddedTextCaption(): ?string
	{
		return $this->embeddedTextCaption;
	}

	public function setCaption(?string $caption): void
	{
		$this->caption = $caption;
	}

	public function getCaption(): ?string
	{
		return $this->caption;
	}

	public function setExifData(PropertyValue $exifData): void
	{
		$this->exifData = $exifData;
	}

	public function getExifData(): PropertyValue
	{
		return $this->exifData;
	}

	public function setRepresentativeOfPage(?bool $representativeOfPage): void
	{
		$this->representativeOfPage = $representativeOfPage;
	}

	public function getRepresentativeOfPage(): ?bool
	{
		return $this->representativeOfPage;
	}
}
