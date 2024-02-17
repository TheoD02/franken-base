<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Enum\MedicalImagingTechnique;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Any medical imaging modality typically used for diagnostic purposes.
 *
 * @see https://schema.org/ImagingTest
 *
 * @internal
 *
 * @coversNothing
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ImagingTest'])]
class ImagingTest extends MedicalTest
{
    /**
     * Imaging technique used.
     *
     * @see https://schema.org/imagingTechnique
     */
    #[ORM\Column]
    #[ApiProperty(types: ['https://schema.org/imagingTechnique'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [MedicalImagingTechnique::class, 'toArray'])]
    private string $imagingTechnique;

    public function setImagingTechnique(string $imagingTechnique): void
    {
        $this->imagingTechnique = $imagingTechnique;
    }

    public function getImagingTechnique(): string
    {
        return $this->imagingTechnique;
    }
}
