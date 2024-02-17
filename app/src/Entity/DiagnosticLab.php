<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A medical laboratory that offers on-site or off-site diagnostic services.
 *
 * @see https://schema.org/DiagnosticLab
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DiagnosticLab'])]
class DiagnosticLab extends MedicalOrganization
{
    /**
     * A diagnostic test or procedure offered by this lab.
     *
     * @see https://schema.org/availableTest
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MedicalTest')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/availableTest'])]
    #[Assert\NotNull]
    private MedicalTest $availableTest;

    public function setAvailableTest(MedicalTest $availableTest): void
    {
        $this->availableTest = $availableTest;
    }

    public function getAvailableTest(): MedicalTest
    {
        return $this->availableTest;
    }
}
