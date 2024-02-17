<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Enum\MedicalSpecialty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A hospital.
 *
 * @see https://schema.org/Hospital
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Hospital'])]
class Hospital extends EmergencyService
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

    /**
     * Indicates data describing a hospital, e.g. a CDC \[\[CDCPMDRecord\]\] or as some kind of \[\[Dataset\]\].
     *
     * @see https://schema.org/healthcareReportingData
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\CDCPMDRecord')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/healthcareReportingData'])]
    #[Assert\NotNull]
    private CDCPMDRecord $healthcareReportingData;

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

    public function setHealthcareReportingData(CDCPMDRecord $healthcareReportingData): void
    {
        $this->healthcareReportingData = $healthcareReportingData;
    }

    public function getHealthcareReportingData(): CDCPMDRecord
    {
        return $this->healthcareReportingData;
    }
}
