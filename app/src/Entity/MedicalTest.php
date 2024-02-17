<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use App\Enum\MedicalEnumeration;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Any medical test, typically performed for diagnostic purposes.
 *
 * @see https://schema.org/MedicalTest
 *
 * @internal
 *
 * @coversNothing
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
    'medicalTest' => MedicalTest::class,
    'bloodTest' => BloodTest::class,
    'pathologyTest' => PathologyTest::class,
    'imagingTest' => ImagingTest::class,
    'medicalTestPanel' => MedicalTestPanel::class,
])]
class MedicalTest extends MedicalEntity
{
    /**
     * Range of acceptable values for a typical patient, when applicable.
     *
     * @see https://schema.org/normalRange
     */
    #[ORM\Column]
    #[ApiProperty(types: ['https://schema.org/normalRange'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [MedicalEnumeration::class, 'toArray'])]
    private string $normalRange;

    /**
     * A condition the test is used to diagnose.
     *
     * @see https://schema.org/usedToDiagnose
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MedicalCondition')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/usedToDiagnose'])]
    #[Assert\NotNull]
    private MedicalCondition $usedToDiagnose;

    /**
     * A sign detected by the test.
     *
     * @see https://schema.org/signDetected
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MedicalSign')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/signDetected'])]
    #[Assert\NotNull]
    private MedicalSign $signDetected;

    /**
     * Drugs that affect the test's results.
     *
     * @see https://schema.org/affectedBy
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Drug')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/affectedBy'])]
    #[Assert\NotNull]
    private Drug $affectedBy;

    /**
     * Device used to perform the test.
     *
     * @see https://schema.org/usesDevice
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MedicalDevice')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/usesDevice'])]
    #[Assert\NotNull]
    private MedicalDevice $usesDevice;

    public function setNormalRange(string $normalRange): void
    {
        $this->normalRange = $normalRange;
    }

    public function getNormalRange(): string
    {
        return $this->normalRange;
    }

    public function setUsedToDiagnose(MedicalCondition $usedToDiagnose): void
    {
        $this->usedToDiagnose = $usedToDiagnose;
    }

    public function getUsedToDiagnose(): MedicalCondition
    {
        return $this->usedToDiagnose;
    }

    public function setSignDetected(MedicalSign $signDetected): void
    {
        $this->signDetected = $signDetected;
    }

    public function getSignDetected(): MedicalSign
    {
        return $this->signDetected;
    }

    public function setAffectedBy(Drug $affectedBy): void
    {
        $this->affectedBy = $affectedBy;
    }

    public function getAffectedBy(): Drug
    {
        return $this->affectedBy;
    }

    public function setUsesDevice(MedicalDevice $usesDevice): void
    {
        $this->usesDevice = $usesDevice;
    }

    public function getUsesDevice(): MedicalDevice
    {
        return $this->usesDevice;
    }
}
