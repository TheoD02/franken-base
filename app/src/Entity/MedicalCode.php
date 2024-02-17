<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A code for a medical entity.
 *
 * @see https://schema.org/MedicalCode
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MedicalCode'])]
class MedicalCode extends MedicalIntangible
{
    /**
     * The coding system, e.g. 'ICD-10'.
     *
     * @see https://schema.org/codingSystem
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/codingSystem'])]
    private ?string $codingSystem = null;

    /**
     * A short textual code that uniquely identifies the value.
     *
     * @see https://schema.org/codeValue
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/codeValue'])]
    private ?string $codeValue = null;

    public function setCodingSystem(?string $codingSystem): void
    {
        $this->codingSystem = $codingSystem;
    }

    public function getCodingSystem(): ?string
    {
        return $this->codingSystem;
    }

    public function setCodeValue(?string $codeValue): void
    {
        $this->codeValue = $codeValue;
    }

    public function getCodeValue(): ?string
    {
        return $this->codeValue;
    }
}
