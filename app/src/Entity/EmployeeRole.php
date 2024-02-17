<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A subclass of OrganizationRole used to describe employee relationships.
 *
 * @see https://schema.org/EmployeeRole
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/EmployeeRole'])]
class EmployeeRole extends OrganizationRole
{
    /**
     * The base salary of the job or of an employee in an EmployeeRole.
     *
     * @see https://schema.org/baseSalary
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\PriceSpecification')]
    #[ApiProperty(types: ['https://schema.org/baseSalary'])]
    private ?PriceSpecification $baseSalary = null;

    /**
     * The currency (coded using \[ISO 4217\](http://en.wikipedia.org/wiki/ISO\_4217)) used for the main salary information in this job posting or for this employee.
     *
     * @see https://schema.org/salaryCurrency
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/salaryCurrency'])]
    private ?string $salaryCurrency = null;

    public function setBaseSalary(?PriceSpecification $baseSalary): void
    {
        $this->baseSalary = $baseSalary;
    }

    public function getBaseSalary(): ?PriceSpecification
    {
        return $this->baseSalary;
    }

    public function setSalaryCurrency(?string $salaryCurrency): void
    {
        $this->salaryCurrency = $salaryCurrency;
    }

    public function getSalaryCurrency(): ?string
    {
        return $this->salaryCurrency;
    }
}
