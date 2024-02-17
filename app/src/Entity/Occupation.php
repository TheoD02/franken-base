<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A profession, may involve prolonged training and/or a formal qualification.
 *
 * @see https://schema.org/Occupation
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Occupation'])]
class Occupation extends Intangible
{
    /**
     * Specific qualifications required for this role or Occupation.
     *
     * @see https://schema.org/qualifications
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\EducationalOccupationalCredential')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/qualifications'])]
    #[Assert\NotNull]
    private EducationalOccupationalCredential $qualifications;

    /**
     * Responsibilities associated with this role or Occupation.
     *
     * @see https://schema.org/responsibilities
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/responsibilities'])]
    private ?string $responsibilities = null;

    /**
     * Educational background needed for the position or Occupation.
     *
     * @see https://schema.org/educationRequirements
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/educationRequirements'])]
    private ?string $educationRequirements = null;

    /**
     * A category describing the job, preferably using a term from a taxonomy such as \[BLS O\*NET-SOC\](http://www.onetcenter.org/taxonomy.html), \[ISCO-08\](https://www.ilo.org/public/english/bureau/stat/isco/isco08/) or similar, with the property repeated for each applicable value. Ideally the taxonomy should be identified, and both the textual label and formal code for the category should be provided.\\n Note: for historical reasons, any textual label and formal code provided as a literal may be assumed to be from O\*NET-SOC.
     *
     * @see https://schema.org/occupationalCategory
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/occupationalCategory'])]
    private ?string $occupationalCategory = null;

    /**
     * The region/country for which this occupational description is appropriate. Note that educational requirements and qualifications can vary between jurisdictions.
     *
     * @see https://schema.org/occupationLocation
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\AdministrativeArea')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/occupationLocation'])]
    #[Assert\NotNull]
    private AdministrativeArea $occupationLocation;

    /**
     * A statement of knowledge, skill, ability, task or any other assertion expressing a competency that is desired or required to fulfill this role or to work in this occupation.
     *
     * @see https://schema.org/skills
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\DefinedTerm')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/skills'])]
    #[Assert\NotNull]
    private DefinedTerm $skills;

    /**
     * An estimated salary for a job posting or occupation, based on a variety of variables including, but not limited to industry, job title, and location. Estimated salaries are often computed by outside organizations rather than the hiring organization, who may not have committed to the estimated value.
     *
     * @see https://schema.org/estimatedSalary
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MonetaryAmountDistribution')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/estimatedSalary'])]
    #[Assert\NotNull]
    private MonetaryAmountDistribution $estimatedSalary;

    /**
     * Description of skills and experience needed for the position or Occupation.
     *
     * @see https://schema.org/experienceRequirements
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/experienceRequirements'])]
    private ?string $experienceRequirements = null;

    public function setQualifications(EducationalOccupationalCredential $qualifications): void
    {
        $this->qualifications = $qualifications;
    }

    public function getQualifications(): EducationalOccupationalCredential
    {
        return $this->qualifications;
    }

    public function setResponsibilities(?string $responsibilities): void
    {
        $this->responsibilities = $responsibilities;
    }

    public function getResponsibilities(): ?string
    {
        return $this->responsibilities;
    }

    public function setEducationRequirements(?string $educationRequirements): void
    {
        $this->educationRequirements = $educationRequirements;
    }

    public function getEducationRequirements(): ?string
    {
        return $this->educationRequirements;
    }

    public function setOccupationalCategory(?string $occupationalCategory): void
    {
        $this->occupationalCategory = $occupationalCategory;
    }

    public function getOccupationalCategory(): ?string
    {
        return $this->occupationalCategory;
    }

    public function setOccupationLocation(AdministrativeArea $occupationLocation): void
    {
        $this->occupationLocation = $occupationLocation;
    }

    public function getOccupationLocation(): AdministrativeArea
    {
        return $this->occupationLocation;
    }

    public function setSkills(DefinedTerm $skills): void
    {
        $this->skills = $skills;
    }

    public function getSkills(): DefinedTerm
    {
        return $this->skills;
    }

    public function setEstimatedSalary(MonetaryAmountDistribution $estimatedSalary): void
    {
        $this->estimatedSalary = $estimatedSalary;
    }

    public function getEstimatedSalary(): MonetaryAmountDistribution
    {
        return $this->estimatedSalary;
    }

    public function setExperienceRequirements(?string $experienceRequirements): void
    {
        $this->experienceRequirements = $experienceRequirements;
    }

    public function getExperienceRequirements(): ?string
    {
        return $this->experienceRequirements;
    }
}
