<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reference documentation for application programming interfaces (APIs).
 *
 * @see https://schema.org/APIReference
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/APIReference'])]
class APIReference extends TechArticle
{
    /**
     * Library file name, e.g., mscorlib.dll, system.web.dll.
     *
     * @see https://schema.org/executableLibraryName
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/executableLibraryName'])]
    private ?string $executableLibraryName = null;

    /**
     * Associated product/technology version. E.g., .NET Framework 4.5.
     *
     * @see https://schema.org/assemblyVersion
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/assemblyVersion'])]
    private ?string $assemblyVersion = null;

    /**
     * Type of app development: phone, Metro style, desktop, XBox, etc.
     *
     * @see https://schema.org/targetPlatform
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/targetPlatform'])]
    private ?string $targetPlatform = null;

    /**
     * Indicates whether API is managed or unmanaged.
     *
     * @see https://schema.org/programmingModel
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/programmingModel'])]
    private ?string $programmingModel = null;

    public function setExecutableLibraryName(?string $executableLibraryName): void
    {
        $this->executableLibraryName = $executableLibraryName;
    }

    public function getExecutableLibraryName(): ?string
    {
        return $this->executableLibraryName;
    }

    public function setAssemblyVersion(?string $assemblyVersion): void
    {
        $this->assemblyVersion = $assemblyVersion;
    }

    public function getAssemblyVersion(): ?string
    {
        return $this->assemblyVersion;
    }

    public function setTargetPlatform(?string $targetPlatform): void
    {
        $this->targetPlatform = $targetPlatform;
    }

    public function getTargetPlatform(): ?string
    {
        return $this->targetPlatform;
    }

    public function setProgrammingModel(?string $programmingModel): void
    {
        $this->programmingModel = $programmingModel;
    }

    public function getProgrammingModel(): ?string
    {
        return $this->programmingModel;
    }
}
