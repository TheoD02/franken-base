<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use App\Enum\MedicalSpecialty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A facility, often associated with a hospital or medical school, that is devoted to the specific diagnosis and/or healthcare. Previously limited to outpatients but with evolution it may be open to inpatients as well.
 *
 * @see https://schema.org/MedicalClinic
 */
#[ORM\MappedSuperclass]
abstract class MedicalClinic extends MedicalBusiness
{
    /**
     * A medical specialty of the provider.
     *
     * @see https://schema.org/medicalSpecialty
     */
    #[ORM\Column]
    #[ApiProperty(types: ['https://schema.org/medicalSpecialty'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [MedicalSpecialty::class, 'toArray'])]
    private string $medicalSpecialty;

    /**
     * A medical service available from this provider.
     *
     * @see https://schema.org/availableService
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MedicalTest')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/availableService'])]
    #[Assert\NotNull]
    private MedicalTest $availableService;

    public function setMedicalSpecialty(string $medicalSpecialty): void
    {
        $this->medicalSpecialty = $medicalSpecialty;
    }

    public function getMedicalSpecialty(): string
    {
        return $this->medicalSpecialty;
    }

    public function setAvailableService(MedicalTest $availableService): void
    {
        $this->availableService = $availableService;
    }

    public function getAvailableService(): MedicalTest
    {
        return $this->availableService;
    }
}
