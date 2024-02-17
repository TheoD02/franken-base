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
 * A software application.
 *
 * @see https://schema.org/SoftwareApplication
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
	'softwareApplication' => SoftwareApplication::class,
	'videoGame' => VideoGame::class,
	'webApplication' => WebApplication::class,
	'mobileApplication' => MobileApplication::class,
])]
class SoftwareApplication extends CreativeWork
{
	/**
	 * Subcategory of the application, e.g. 'Arcade Game'.
	 *
	 * @see https://schema.org/applicationSubCategory
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/applicationSubCategory'])]
	private ?string $applicationSubCategory = null;

	/**
	 * Storage requirements (free space required).
	 *
	 * @see https://schema.org/storageRequirements
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/storageRequirements'])]
	private ?string $storageRequirements = null;

	/**
	 * Component dependency requirements for application. This includes runtime environments and shared libraries that are not included in the application distribution package, but required to run the application (examples: DirectX, Java or .NET runtime).
	 *
	 * @see https://schema.org/softwareRequirements
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/softwareRequirements'])]
	private ?string $softwareRequirements = null;

	/**
	 * Operating systems supported (Windows 7, OS X 10.6, Android 1.6).
	 *
	 * @see https://schema.org/operatingSystem
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/operatingSystem'])]
	private ?string $operatingSystem = null;

	/**
	 * Additional content for a software application.
	 *
	 * @see https://schema.org/softwareAddOn
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\SoftwareApplication')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/softwareAddOn'])]
	#[Assert\NotNull]
	private SoftwareApplication $softwareAddOn;

	/**
	 * @var Collection<Text>|null Permission(s) required to run the app (for example, a mobile app may require full internet access or may run only on wifi).
	 * @see https://schema.org/permissions
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinTable(name: 'software_application_text_permissions')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/permissions'])]
	private ?Collection $permissions = null;

	/**
	 * Version of the software instance.
	 *
	 * @see https://schema.org/softwareVersion
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/softwareVersion'])]
	private ?string $softwareVersion = null;

	/**
	 * If the file can be downloaded, URL to download the binary.
	 *
	 * @see https://schema.org/downloadUrl
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/downloadUrl'])]
	#[Assert\Url]
	private ?string $downloadUrl = null;

	/**
	 * URL at which the app may be installed, if different from the URL of the item.
	 *
	 * @see https://schema.org/installUrl
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/installUrl'])]
	#[Assert\Url]
	private ?string $installUrl = null;

	/**
	 * Supporting data for a SoftwareApplication.
	 *
	 * @see https://schema.org/supportingData
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\DataFeed')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/supportingData'])]
	#[Assert\NotNull]
	private DataFeed $supportingData;

	/**
	 * The name of the application suite to which the application belongs (e.g. Excel belongs to Office).
	 *
	 * @see https://schema.org/applicationSuite
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/applicationSuite'])]
	private ?string $applicationSuite = null;

	/**
	 * Type of software application, e.g. 'Game, Multimedia'.
	 *
	 * @see https://schema.org/applicationCategory
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/applicationCategory'])]
	private ?string $applicationCategory = null;

	/**
	 * Software application help.
	 *
	 * @see https://schema.org/softwareHelp
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWork')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/softwareHelp'])]
	#[Assert\NotNull]
	private CreativeWork $softwareHelp;

	/**
	 * Size of the application / package (e.g. 18MB). In the absence of a unit (MB, KB etc.), KB will be assumed.
	 *
	 * @see https://schema.org/fileSize
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/fileSize'])]
	private ?string $fileSize = null;

	/**
	 * Processor architecture required to run the application (e.g. IA64).
	 *
	 * @see https://schema.org/processorRequirements
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/processorRequirements'])]
	private ?string $processorRequirements = null;

	/**
	 * Device required to run the application. Used in cases where a specific make/model is required to run the application.
	 *
	 * @see https://schema.org/availableOnDevice
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/availableOnDevice'])]
	private ?string $availableOnDevice = null;

	/**
	 * Description of what changed in this version.
	 *
	 * @see https://schema.org/releaseNotes
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/releaseNotes'])]
	private ?string $releaseNotes = null;

	/**
	 * Countries for which the application is supported. You can also provide the two-letter ISO 3166-1 alpha-2 country code.
	 *
	 * @see https://schema.org/countriesSupported
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/countriesSupported'])]
	private ?string $countriesSupported = null;

	/**
	 * Features or modules provided by this application (and possibly required by other applications).
	 *
	 * @see https://schema.org/featureList
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/featureList'])]
	private ?string $featureList = null;

	/**
	 * A link to a screenshot image of the app.
	 *
	 * @see https://schema.org/screenshot
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\ImageObject')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/screenshot'])]
	#[Assert\NotNull]
	private ImageObject $screenshot;

	/**
	 * Countries for which the application is not supported. You can also provide the two-letter ISO 3166-1 alpha-2 country code.
	 *
	 * @see https://schema.org/countriesNotSupported
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/countriesNotSupported'])]
	private ?string $countriesNotSupported = null;

	/**
	 * Minimum memory requirements.
	 *
	 * @see https://schema.org/memoryRequirements
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/memoryRequirements'])]
	private ?string $memoryRequirements = null;

	function __construct()
	{
		parent::__construct();
		$this->permissions = new ArrayCollection();
	}

	public function setApplicationSubCategory(?string $applicationSubCategory): void
	{
		$this->applicationSubCategory = $applicationSubCategory;
	}

	public function getApplicationSubCategory(): ?string
	{
		return $this->applicationSubCategory;
	}

	public function setStorageRequirements(?string $storageRequirements): void
	{
		$this->storageRequirements = $storageRequirements;
	}

	public function getStorageRequirements(): ?string
	{
		return $this->storageRequirements;
	}

	public function setSoftwareRequirements(?string $softwareRequirements): void
	{
		$this->softwareRequirements = $softwareRequirements;
	}

	public function getSoftwareRequirements(): ?string
	{
		return $this->softwareRequirements;
	}

	public function setOperatingSystem(?string $operatingSystem): void
	{
		$this->operatingSystem = $operatingSystem;
	}

	public function getOperatingSystem(): ?string
	{
		return $this->operatingSystem;
	}

	public function setSoftwareAddOn(SoftwareApplication $softwareAddOn): void
	{
		$this->softwareAddOn = $softwareAddOn;
	}

	public function getSoftwareAddOn(): SoftwareApplication
	{
		return $this->softwareAddOn;
	}

	public function addPermission(string $permission): void
	{
		$this->permissions[] = $permission;
	}

	public function removePermission(string $permission): void
	{
		$this->permissions->removeElement($permission);
	}

	/**
	 * @return Collection<Text>|null
	 */
	public function getPermissions(): Collection
	{
		return $this->permissions;
	}

	public function setSoftwareVersion(?string $softwareVersion): void
	{
		$this->softwareVersion = $softwareVersion;
	}

	public function getSoftwareVersion(): ?string
	{
		return $this->softwareVersion;
	}

	public function setDownloadUrl(?string $downloadUrl): void
	{
		$this->downloadUrl = $downloadUrl;
	}

	public function getDownloadUrl(): ?string
	{
		return $this->downloadUrl;
	}

	public function setInstallUrl(?string $installUrl): void
	{
		$this->installUrl = $installUrl;
	}

	public function getInstallUrl(): ?string
	{
		return $this->installUrl;
	}

	public function setSupportingData(DataFeed $supportingData): void
	{
		$this->supportingData = $supportingData;
	}

	public function getSupportingData(): DataFeed
	{
		return $this->supportingData;
	}

	public function setApplicationSuite(?string $applicationSuite): void
	{
		$this->applicationSuite = $applicationSuite;
	}

	public function getApplicationSuite(): ?string
	{
		return $this->applicationSuite;
	}

	public function setApplicationCategory(?string $applicationCategory): void
	{
		$this->applicationCategory = $applicationCategory;
	}

	public function getApplicationCategory(): ?string
	{
		return $this->applicationCategory;
	}

	public function setSoftwareHelp(CreativeWork $softwareHelp): void
	{
		$this->softwareHelp = $softwareHelp;
	}

	public function getSoftwareHelp(): CreativeWork
	{
		return $this->softwareHelp;
	}

	public function setFileSize(?string $fileSize): void
	{
		$this->fileSize = $fileSize;
	}

	public function getFileSize(): ?string
	{
		return $this->fileSize;
	}

	public function setProcessorRequirements(?string $processorRequirements): void
	{
		$this->processorRequirements = $processorRequirements;
	}

	public function getProcessorRequirements(): ?string
	{
		return $this->processorRequirements;
	}

	public function setAvailableOnDevice(?string $availableOnDevice): void
	{
		$this->availableOnDevice = $availableOnDevice;
	}

	public function getAvailableOnDevice(): ?string
	{
		return $this->availableOnDevice;
	}

	public function setReleaseNotes(?string $releaseNotes): void
	{
		$this->releaseNotes = $releaseNotes;
	}

	public function getReleaseNotes(): ?string
	{
		return $this->releaseNotes;
	}

	public function setCountriesSupported(?string $countriesSupported): void
	{
		$this->countriesSupported = $countriesSupported;
	}

	public function getCountriesSupported(): ?string
	{
		return $this->countriesSupported;
	}

	public function setFeatureList(?string $featureList): void
	{
		$this->featureList = $featureList;
	}

	public function getFeatureList(): ?string
	{
		return $this->featureList;
	}

	public function setScreenshot(ImageObject $screenshot): void
	{
		$this->screenshot = $screenshot;
	}

	public function getScreenshot(): ImageObject
	{
		return $this->screenshot;
	}

	public function setCountriesNotSupported(?string $countriesNotSupported): void
	{
		$this->countriesNotSupported = $countriesNotSupported;
	}

	public function getCountriesNotSupported(): ?string
	{
		return $this->countriesNotSupported;
	}

	public function setMemoryRequirements(?string $memoryRequirements): void
	{
		$this->memoryRequirements = $memoryRequirements;
	}

	public function getMemoryRequirements(): ?string
	{
		return $this->memoryRequirements;
	}
}
