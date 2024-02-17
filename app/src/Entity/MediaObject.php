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
 * A media object, such as an image, video, audio, or text object embedded in a web page or a downloadable dataset i.e. DataDownload. Note that a creative work may have many media objects associated with it on the same web page. For example, a page about a single song (MusicRecording) may have a music video (VideoObject), and a high and low bandwidth audio stream (2 AudioObject's).
 *
 * @see https://schema.org/MediaObject
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
	'mediaObject' => MediaObject::class,
	'musicVideoObject' => MusicVideoObject::class,
	'ampStory' => AmpStory::class,
	'dataDownload' => DataDownload::class,
	'audioObject' => AudioObject::class,
	'videoObject' => VideoObject::class,
	'3DModel' => 3DModel::class,
	'textObject' => TextObject::class,
	'imageObject' => ImageObject::class,
	'audioObjectSnapshot' => AudioObjectSnapshot::class,
	'videoObjectSnapshot' => VideoObjectSnapshot::class,
	'barcode' => Barcode::class,
	'imageObjectSnapshot' => ImageObjectSnapshot::class,
])]
class MediaObject extends CreativeWork
{
	/**
	 * The \[SHA-2\](https://en.wikipedia.org/wiki/SHA-2) SHA256 hash of the content of the item. For example, a zero-length input has value 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855'.
	 *
	 * @see https://schema.org/sha256
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/sha256'])]
	private ?string $sha256 = null;

	/**
	 * The regions where the media is allowed. If not specified, then it's assumed to be allowed everywhere. Specify the countries in \[ISO 3166 format\](http://en.wikipedia.org/wiki/ISO\_3166).
	 *
	 * @see https://schema.org/regionsAllowed
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Place')]
	#[ApiProperty(types: ['https://schema.org/regionsAllowed'])]
	private ?Place $regionsAllowed = null;

	/**
	 * The endTime of something. For a reserved event or service (e.g. FoodEstablishmentReservation), the time that it is expected to end. For actions that span a period of time, when the action was performed. E.g. John wrote a book from January to \*December\*. For media, including audio and video, it's the time offset of the end of a clip within a larger file.\\n\\nNote that Event uses startDate/endDate instead of startTime/endTime, even when describing dates with times. This situation may be clarified in future revisions.
	 *
	 * @see https://schema.org/endTime
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Time')]
	#[ApiProperty(types: ['https://schema.org/endTime'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $endTime = null;

	/**
	 * The startTime of something. For a reserved event or service (e.g. FoodEstablishmentReservation), the time that it is expected to start. For actions that span a period of time, when the action was performed. E.g. John wrote a book from \*January\* to December. For media, including audio and video, it's the time offset of the start of a clip within a larger file.\\n\\nNote that Event uses startDate/endDate instead of startTime/endTime, even when describing dates with times. This situation may be clarified in future revisions.
	 *
	 * @see https://schema.org/startTime
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Time')]
	#[ApiProperty(types: ['https://schema.org/startTime'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $startTime = null;

	/**
	 * Player type required—for example, Flash or Silverlight.
	 *
	 * @see https://schema.org/playerType
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/playerType'])]
	private ?string $playerType = null;

	/**
	 * The bitrate of the media object.
	 *
	 * @see https://schema.org/bitrate
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/bitrate'])]
	private ?string $bitrate = null;

	/**
	 * The width of the item.
	 *
	 * @see https://schema.org/width
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
	#[ApiProperty(types: ['https://schema.org/width'])]
	private ?QuantitativeValue $width = null;

	/**
	 * The production company or studio responsible for the item, e.g. series, video game, episode etc.
	 *
	 * @see https://schema.org/productionCompany
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ApiProperty(types: ['https://schema.org/productionCompany'])]
	private ?Organization $productionCompany = null;

	/**
	 * A URL pointing to a player for a specific video. In general, this is the information in the ```src``` element of an ```embed``` tag and should not be the same as the content of the ```loc``` tag.
	 *
	 * @see https://schema.org/embedUrl
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/embedUrl'])]
	#[Assert\Url]
	private ?string $embedUrl = null;

	/**
	 * Actual bytes of the media object, for example the image file or video file.
	 *
	 * @see https://schema.org/contentUrl
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/contentUrl'])]
	#[Assert\Url]
	private ?string $contentUrl = null;

	/**
	 * A NewsArticle associated with the Media Object.
	 *
	 * @see https://schema.org/associatedArticle
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\NewsArticle')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/associatedArticle'])]
	#[Assert\NotNull]
	private NewsArticle $associatedArticle;

	/**
	 * @var Collection<Text>|null The ISO 3166-1 (ISO 3166-1 alpha-2) or ISO 3166-2 code, the place, or the GeoShape for the geo-political region(s) for which the offer or delivery charge specification is not valid, e.g. a region where the transaction is not allowed.\\n\\nSee also \[\[eligibleRegion\]\].
	 * @see https://schema.org/ineligibleRegion
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinTable(name: 'media_object_text_ineligible_region')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/ineligibleRegion'])]
	private ?Collection $ineligibleRegion = null;

	/**
	 * Indicates if use of the media require a subscription (either paid or free). Allowed values are ```true``` or ```false``` (note that an earlier version had 'yes', 'no').
	 *
	 * @see https://schema.org/requiresSubscription
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MediaSubscription')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/requiresSubscription'])]
	#[Assert\NotNull]
	private MediaSubscription $requiresSubscription;

	/**
	 * The duration of the item (movie, audio recording, event, etc.) in \[ISO 8601 date format\](http://en.wikipedia.org/wiki/ISO\_8601).
	 *
	 * @see https://schema.org/duration
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Duration')]
	#[ApiProperty(types: ['https://schema.org/duration'])]
	private ?Duration $duration = null;

	/**
	 * File size in (mega/kilo)bytes.
	 *
	 * @see https://schema.org/contentSize
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/contentSize'])]
	private ?string $contentSize = null;

	/**
	 * The height of the item.
	 *
	 * @see https://schema.org/height
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
	#[ApiProperty(types: ['https://schema.org/height'])]
	private ?QuantitativeValue $height = null;

	/**
	 * Date (including time if available) when this media object was uploaded to this site.
	 *
	 * @see https://schema.org/uploadDate
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Date')]
	#[ApiProperty(types: ['https://schema.org/uploadDate'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $uploadDate = null;

	/**
	 * The CreativeWork encoded by this media object.
	 *
	 * @see https://schema.org/encodesCreativeWork
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWork')]
	#[ApiProperty(types: ['https://schema.org/encodesCreativeWork'])]
	private ?CreativeWork $encodesCreativeWork = null;

	function __construct()
	{
		parent::__construct();
		$this->ineligibleRegion = new ArrayCollection();
	}

	public function setSha256(?string $sha256): void
	{
		$this->sha256 = $sha256;
	}

	public function getSha256(): ?string
	{
		return $this->sha256;
	}

	public function setRegionsAllowed(?Place $regionsAllowed): void
	{
		$this->regionsAllowed = $regionsAllowed;
	}

	public function getRegionsAllowed(): ?Place
	{
		return $this->regionsAllowed;
	}

	public function setEndTime(?\DateTimeInterface $endTime): void
	{
		$this->endTime = $endTime;
	}

	public function getEndTime(): ?\DateTimeInterface
	{
		return $this->endTime;
	}

	public function setStartTime(?\DateTimeInterface $startTime): void
	{
		$this->startTime = $startTime;
	}

	public function getStartTime(): ?\DateTimeInterface
	{
		return $this->startTime;
	}

	public function setPlayerType(?string $playerType): void
	{
		$this->playerType = $playerType;
	}

	public function getPlayerType(): ?string
	{
		return $this->playerType;
	}

	public function setBitrate(?string $bitrate): void
	{
		$this->bitrate = $bitrate;
	}

	public function getBitrate(): ?string
	{
		return $this->bitrate;
	}

	public function setWidth(?QuantitativeValue $width): void
	{
		$this->width = $width;
	}

	public function getWidth(): ?QuantitativeValue
	{
		return $this->width;
	}

	public function setProductionCompany(?Organization $productionCompany): void
	{
		$this->productionCompany = $productionCompany;
	}

	public function getProductionCompany(): ?Organization
	{
		return $this->productionCompany;
	}

	public function setEmbedUrl(?string $embedUrl): void
	{
		$this->embedUrl = $embedUrl;
	}

	public function getEmbedUrl(): ?string
	{
		return $this->embedUrl;
	}

	public function setContentUrl(?string $contentUrl): void
	{
		$this->contentUrl = $contentUrl;
	}

	public function getContentUrl(): ?string
	{
		return $this->contentUrl;
	}

	public function setAssociatedArticle(NewsArticle $associatedArticle): void
	{
		$this->associatedArticle = $associatedArticle;
	}

	public function getAssociatedArticle(): NewsArticle
	{
		return $this->associatedArticle;
	}

	public function addIneligibleRegion(string $ineligibleRegion): void
	{
		$this->ineligibleRegion[] = $ineligibleRegion;
	}

	public function removeIneligibleRegion(string $ineligibleRegion): void
	{
		$this->ineligibleRegion->removeElement($ineligibleRegion);
	}

	/**
	 * @return Collection<Text>|null
	 */
	public function getIneligibleRegion(): Collection
	{
		return $this->ineligibleRegion;
	}

	public function setRequiresSubscription(MediaSubscription $requiresSubscription): void
	{
		$this->requiresSubscription = $requiresSubscription;
	}

	public function getRequiresSubscription(): MediaSubscription
	{
		return $this->requiresSubscription;
	}

	public function setDuration(?Duration $duration): void
	{
		$this->duration = $duration;
	}

	public function getDuration(): ?Duration
	{
		return $this->duration;
	}

	public function setContentSize(?string $contentSize): void
	{
		$this->contentSize = $contentSize;
	}

	public function getContentSize(): ?string
	{
		return $this->contentSize;
	}

	public function setHeight(?QuantitativeValue $height): void
	{
		$this->height = $height;
	}

	public function getHeight(): ?QuantitativeValue
	{
		return $this->height;
	}

	public function setUploadDate(?\DateTimeInterface $uploadDate): void
	{
		$this->uploadDate = $uploadDate;
	}

	public function getUploadDate(): ?\DateTimeInterface
	{
		return $this->uploadDate;
	}

	public function setEncodesCreativeWork(?CreativeWork $encodesCreativeWork): void
	{
		$this->encodesCreativeWork = $encodesCreativeWork;
	}

	public function getEncodesCreativeWork(): ?CreativeWork
	{
		return $this->encodesCreativeWork;
	}
}
