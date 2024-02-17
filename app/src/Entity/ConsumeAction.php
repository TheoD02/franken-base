<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The act of ingesting information/resources/food.
 *
 * @see https://schema.org/ConsumeAction
 */
#[ORM\MappedSuperclass]
abstract class ConsumeAction extends Action
{
    /**
     * A set of requirements that must be fulfilled in order to perform an Action. If more than one value is specified, fulfilling one set of requirements will allow the Action to be performed.
     *
     * @see https://schema.org/actionAccessibilityRequirement
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\ActionAccessSpecification')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/actionAccessibilityRequirement'])]
    #[Assert\NotNull]
    private ActionAccessSpecification $actionAccessibilityRequirement;

    /**
     * An Offer which must be accepted before the user can perform the Action. For example, the user may need to buy a movie before being able to watch it.
     *
     * @see https://schema.org/expectsAcceptanceOf
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Offer')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/expectsAcceptanceOf'])]
    #[Assert\NotNull]
    private Offer $expectsAcceptanceOf;

    public function setActionAccessibilityRequirement(ActionAccessSpecification $actionAccessibilityRequirement): void
    {
        $this->actionAccessibilityRequirement = $actionAccessibilityRequirement;
    }

    public function getActionAccessibilityRequirement(): ActionAccessSpecification
    {
        return $this->actionAccessibilityRequirement;
    }

    public function setExpectsAcceptanceOf(Offer $expectsAcceptanceOf): void
    {
        $this->expectsAcceptanceOf = $expectsAcceptanceOf;
    }

    public function getExpectsAcceptanceOf(): Offer
    {
        return $this->expectsAcceptanceOf;
    }
}
