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
 * A delivery service through which content is provided via broadcast over the air or online.
 *
 * @see https://schema.org/BroadcastService
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap(['broadcastService' => BroadcastService::class, 'radioBroadcastService' => RadioBroadcastService::class])]
class BroadcastService extends Service
{
	/**
	 * The language of the content or performance or used in an action. Please use one of the language codes from the \[IETF BCP 47 standard\](http://tools.ietf.org/html/bcp47). See also \[\[availableLanguage\]\].
	 *
	 * @see https://schema.org/inLanguage
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/inLanguage'])]
	private ?string $inLanguage = null;

	/**
	 * A broadcast service to which the broadcast service may belong to such as regional variations of a national channel.
	 *
	 * @see https://schema.org/parentService
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\BroadcastService')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/parentService'])]
	#[Assert\NotNull]
	private BroadcastService $parentService;

	/**
	 * A \[callsign\](https://en.wikipedia.org/wiki/Call\_sign), as used in broadcasting and radio communications to identify people, radio and TV stations, or vehicles.
	 *
	 * @see https://schema.org/callSign
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/callSign'])]
	private ?string $callSign = null;

	/**
	 * @var Collection<Organization>|null The media network(s) whose content is broadcast on this station.
	 * @see https://schema.org/broadcastAffiliateOf
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Organization')]
	#[ORM\JoinTable(name: 'broadcast_service_organization_broadcast_affiliate_of')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/broadcastAffiliateOf'])]
	private ?Collection $broadcastAffiliateOf = null;

	/**
	 * The frequency used for over-the-air broadcasts. Numeric values or simple ranges, e.g. 87-99. In addition a shortcut idiom is supported for frequences of AM and FM radio channels, e.g. "87 FM".
	 *
	 * @see https://schema.org/broadcastFrequency
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\BroadcastFrequencySpecification')]
	#[ApiProperty(types: ['https://schema.org/broadcastFrequency'])]
	private ?BroadcastFrequencySpecification $broadcastFrequency = null;

	/**
	 * The name displayed in the channel guide. For many US affiliates, it is the network name.
	 *
	 * @see https://schema.org/broadcastDisplayName
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/broadcastDisplayName'])]
	private ?string $broadcastDisplayName = null;

	/**
	 * The type of screening or video broadcast used (e.g. IMAX, 3D, SD, HD, etc.).
	 *
	 * @see https://schema.org/videoFormat
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/videoFormat'])]
	private ?string $videoFormat = null;

	/**
	 * The organization owning or operating the broadcast service.
	 *
	 * @see https://schema.org/broadcaster
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ApiProperty(types: ['https://schema.org/broadcaster'])]
	private ?Organization $broadcaster = null;

	/**
	 * The timezone in \[ISO 8601 format\](http://en.wikipedia.org/wiki/ISO\_8601) for which the service bases its broadcasts.
	 *
	 * @see https://schema.org/broadcastTimezone
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/broadcastTimezone'])]
	private ?string $broadcastTimezone = null;

	/**
	 * A broadcast channel of a broadcast service.
	 *
	 * @see https://schema.org/hasBroadcastChannel
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\BroadcastChannel')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/hasBroadcastChannel'])]
	#[Assert\NotNull]
	private BroadcastChannel $hasBroadcastChannel;

	function __construct()
	{
		parent::__construct();
		$this->broadcastAffiliateOf = new ArrayCollection();
	}

	public function setInLanguage(?string $inLanguage): void
	{
		$this->inLanguage = $inLanguage;
	}

	public function getInLanguage(): ?string
	{
		return $this->inLanguage;
	}

	public function setParentService(BroadcastService $parentService): void
	{
		$this->parentService = $parentService;
	}

	public function getParentService(): BroadcastService
	{
		return $this->parentService;
	}

	public function setCallSign(?string $callSign): void
	{
		$this->callSign = $callSign;
	}

	public function getCallSign(): ?string
	{
		return $this->callSign;
	}

	public function addBroadcastAffiliateOf(Organization $broadcastAffiliateOf): void
	{
		$this->broadcastAffiliateOf[] = $broadcastAffiliateOf;
	}

	public function removeBroadcastAffiliateOf(Organization $broadcastAffiliateOf): void
	{
		$this->broadcastAffiliateOf->removeElement($broadcastAffiliateOf);
	}

	/**
	 * @return Collection<Organization>|null
	 */
	public function getBroadcastAffiliateOf(): Collection
	{
		return $this->broadcastAffiliateOf;
	}

	public function setBroadcastFrequency(?BroadcastFrequencySpecification $broadcastFrequency): void
	{
		$this->broadcastFrequency = $broadcastFrequency;
	}

	public function getBroadcastFrequency(): ?BroadcastFrequencySpecification
	{
		return $this->broadcastFrequency;
	}

	public function setBroadcastDisplayName(?string $broadcastDisplayName): void
	{
		$this->broadcastDisplayName = $broadcastDisplayName;
	}

	public function getBroadcastDisplayName(): ?string
	{
		return $this->broadcastDisplayName;
	}

	public function setVideoFormat(?string $videoFormat): void
	{
		$this->videoFormat = $videoFormat;
	}

	public function getVideoFormat(): ?string
	{
		return $this->videoFormat;
	}

	public function setBroadcaster(?Organization $broadcaster): void
	{
		$this->broadcaster = $broadcaster;
	}

	public function getBroadcaster(): ?Organization
	{
		return $this->broadcaster;
	}

	public function setBroadcastTimezone(?string $broadcastTimezone): void
	{
		$this->broadcastTimezone = $broadcastTimezone;
	}

	public function getBroadcastTimezone(): ?string
	{
		return $this->broadcastTimezone;
	}

	public function setHasBroadcastChannel(BroadcastChannel $hasBroadcastChannel): void
	{
		$this->hasBroadcastChannel = $hasBroadcastChannel;
	}

	public function getHasBroadcastChannel(): BroadcastChannel
	{
		return $this->hasBroadcastChannel;
	}
}
