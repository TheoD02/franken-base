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
 * Computer programming source code. Example: Full (compile ready) solutions, code snippet samples, scripts, templates.
 *
 * @see https://schema.org/SoftwareSourceCode
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SoftwareSourceCode'])]
class SoftwareSourceCode extends CreativeWork
{
	/**
	 * The computer programming language.
	 *
	 * @see https://schema.org/programmingLanguage
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/programmingLanguage'])]
	private ?string $programmingLanguage = null;

	/**
	 * Link to the repository where the un-compiled, human readable code and related code is located (SVN, GitHub, CodePlex).
	 *
	 * @see https://schema.org/codeRepository
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/codeRepository'])]
	#[Assert\Url]
	private ?string $codeRepository = null;

	/**
	 * Target Operating System / Product to which the code applies. If applies to several versions, just the product name can be used.
	 *
	 * @see https://schema.org/targetProduct
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\SoftwareApplication')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/targetProduct'])]
	#[Assert\NotNull]
	private SoftwareApplication $targetProduct;

	/**
	 * Runtime platform or script interpreter dependencies (example: Java v1, Python 2.3, .NET Framework 3.0).
	 *
	 * @see https://schema.org/runtimePlatform
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/runtimePlatform'])]
	private ?string $runtimePlatform = null;

	/**
	 * What type of code sample: full (compile ready) solution, code snippet, inline code, scripts, template.
	 *
	 * @see https://schema.org/codeSampleType
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/codeSampleType'])]
	private ?string $codeSampleType = null;

	public function setProgrammingLanguage(?string $programmingLanguage): void
	{
		$this->programmingLanguage = $programmingLanguage;
	}

	public function getProgrammingLanguage(): ?string
	{
		return $this->programmingLanguage;
	}

	public function setCodeRepository(?string $codeRepository): void
	{
		$this->codeRepository = $codeRepository;
	}

	public function getCodeRepository(): ?string
	{
		return $this->codeRepository;
	}

	public function setTargetProduct(SoftwareApplication $targetProduct): void
	{
		$this->targetProduct = $targetProduct;
	}

	public function getTargetProduct(): SoftwareApplication
	{
		return $this->targetProduct;
	}

	public function setRuntimePlatform(?string $runtimePlatform): void
	{
		$this->runtimePlatform = $runtimePlatform;
	}

	public function getRuntimePlatform(): ?string
	{
		return $this->runtimePlatform;
	}

	public function setCodeSampleType(?string $codeSampleType): void
	{
		$this->codeSampleType = $codeSampleType;
	}

	public function getCodeSampleType(): ?string
	{
		return $this->codeSampleType;
	}
}
