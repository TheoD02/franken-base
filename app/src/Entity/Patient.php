<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A patient is any person recipient of health care services.
 *
 * @see https://schema.org/Patient
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Patient'])]
class Patient extends Person
{
    /**
     * @var Collection<MedicalCondition>|null one or more alternative conditions considered in the differential diagnosis process as output of a diagnosis process
     *
     * @see https://schema.org/diagnosis
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\MedicalCondition')]
    #[ORM\JoinTable(name: 'patient_medical_condition_diagnosis')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/diagnosis'])]
    private ?Collection $diagnosis = null;

    /**
     * Specifying a drug or medicine used in a medication procedure.
     *
     * @see https://schema.org/drug
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Drug')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/drug'])]
    #[Assert\NotNull]
    private Drug $drug;

    /**
     * @var Collection<MedicalCondition>|null specifying the health condition(s) of a patient, medical study, or other target audience
     *
     * @see https://schema.org/healthCondition
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\MedicalCondition')]
    #[ORM\JoinTable(name: 'patient_medical_condition_health_condition')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/healthCondition'])]
    private ?Collection $healthCondition = null;

    public function __construct()
    {
        parent::__construct();
        $this->diagnosis = new ArrayCollection();
        $this->healthCondition = new ArrayCollection();
    }

    public function addDiagnosi(MedicalCondition $diagnosi): void
    {
        $this->diagnosis[] = $diagnosi;
    }

    public function removeDiagnosi(MedicalCondition $diagnosi): void
    {
        $this->diagnosis->removeElement($diagnosi);
    }

    /**
     * @return Collection<MedicalCondition>|null
     */
    public function getDiagnosis(): Collection
    {
        return $this->diagnosis;
    }

    public function setDrug(Drug $drug): void
    {
        $this->drug = $drug;
    }

    public function getDrug(): Drug
    {
        return $this->drug;
    }

    public function addHealthCondition(MedicalCondition $healthCondition): void
    {
        $this->healthCondition[] = $healthCondition;
    }

    public function removeHealthCondition(MedicalCondition $healthCondition): void
    {
        $this->healthCondition->removeElement($healthCondition);
    }

    /**
     * @return Collection<MedicalCondition>|null
     */
    public function getHealthCondition(): Collection
    {
        return $this->healthCondition;
    }
}
