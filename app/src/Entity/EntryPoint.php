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
 * An entry point, within some Web-based protocol.
 *
 * @see https://schema.org/EntryPoint
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/EntryPoint'])]
class EntryPoint extends Intangible
{
	/**
	 * An url template (RFC6570) that will be used to construct the target of the execution of the action.
	 *
	 * @see https://schema.org/urlTemplate
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/urlTemplate'])]
	private ?string $urlTemplate = null;

	/**
	 * An HTTP method that specifies the appropriate HTTP method for a request to an HTTP EntryPoint. Values are capitalized strings as used in HTTP.
	 *
	 * @see https://schema.org/httpMethod
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/httpMethod'])]
	private ?string $httpMethod = null;

	/**
	 * @var Collection<Text>|null The high level platform(s) where the Action can be performed for the given URL. To specify a specific application or operating system instance, use actionApplication.
	 * @see https://schema.org/actionPlatform
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinTable(name: 'entry_point_text_action_platform')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/actionPlatform'])]
	private ?Collection $actionPlatform = null;

	/**
	 * An application that can complete the request.
	 *
	 * @see https://schema.org/actionApplication
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\SoftwareApplication')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/actionApplication'])]
	#[Assert\NotNull]
	private SoftwareApplication $actionApplication;

	/**
	 * @var Collection<Text>|null The supported content type(s) for an EntryPoint response.
	 * @see https://schema.org/contentType
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinTable(name: 'entry_point_text_content_type')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/contentType'])]
	private ?Collection $contentType = null;

	/**
	 * @var Collection<Text>|null The supported encoding type(s) for an EntryPoint request.
	 * @see https://schema.org/encodingType
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinTable(name: 'entry_point_text_encoding_type')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/encodingType'])]
	private ?Collection $encodingType = null;

	function __construct()
	{
		$this->actionPlatform = new ArrayCollection();
		$this->contentType = new ArrayCollection();
		$this->encodingType = new ArrayCollection();
	}

	public function setUrlTemplate(?string $urlTemplate): void
	{
		$this->urlTemplate = $urlTemplate;
	}

	public function getUrlTemplate(): ?string
	{
		return $this->urlTemplate;
	}

	public function setHttpMethod(?string $httpMethod): void
	{
		$this->httpMethod = $httpMethod;
	}

	public function getHttpMethod(): ?string
	{
		return $this->httpMethod;
	}

	public function addActionPlatform(string $actionPlatform): void
	{
		$this->actionPlatform[] = $actionPlatform;
	}

	public function removeActionPlatform(string $actionPlatform): void
	{
		$this->actionPlatform->removeElement($actionPlatform);
	}

	/**
	 * @return Collection<Text>|null
	 */
	public function getActionPlatform(): Collection
	{
		return $this->actionPlatform;
	}

	public function setActionApplication(SoftwareApplication $actionApplication): void
	{
		$this->actionApplication = $actionApplication;
	}

	public function getActionApplication(): SoftwareApplication
	{
		return $this->actionApplication;
	}

	public function addContentType(string $contentType): void
	{
		$this->contentType[] = $contentType;
	}

	public function removeContentType(string $contentType): void
	{
		$this->contentType->removeElement($contentType);
	}

	/**
	 * @return Collection<Text>|null
	 */
	public function getContentType(): Collection
	{
		return $this->contentType;
	}

	public function addEncodingType(string $encodingType): void
	{
		$this->encodingType[] = $encodingType;
	}

	public function removeEncodingType(string $encodingType): void
	{
		$this->encodingType->removeElement($encodingType);
	}

	/**
	 * @return Collection<Text>|null
	 */
	public function getEncodingType(): Collection
	{
		return $this->encodingType;
	}
}
