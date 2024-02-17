<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;

/**
 * A technical article - Example: How-to (task) topics, step-by-step, procedural troubleshooting, specifications, etc.
 *
 * @see https://schema.org/TechArticle
 */
#[ORM\MappedSuperclass]
abstract class TechArticle extends Article
{
    /**
     * Prerequisites needed to fulfill steps in article.
     *
     * @see https://schema.org/dependencies
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/dependencies'])]
    private ?string $dependencies = null;

    /**
     * Proficiency needed for this content; expected values: 'Beginner', 'Expert'.
     *
     * @see https://schema.org/proficiencyLevel
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/proficiencyLevel'])]
    private ?string $proficiencyLevel = null;

    public function setDependencies(?string $dependencies): void
    {
        $this->dependencies = $dependencies;
    }

    public function getDependencies(): ?string
    {
        return $this->dependencies;
    }

    public function setProficiencyLevel(?string $proficiencyLevel): void
    {
        $this->proficiencyLevel = $proficiencyLevel;
    }

    public function getProficiencyLevel(): ?string
    {
        return $this->proficiencyLevel;
    }
}
