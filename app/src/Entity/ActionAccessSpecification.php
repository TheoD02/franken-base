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
 * A set of requirements that must be fulfilled in order to perform an Action.
 *
 * @see https://schema.org/ActionAccessSpecification
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ActionAccessSpecification'])]
class ActionAccessSpecification extends Intangible
{
    /**
     * The end of the availability of the product or service included in the offer.
     *
     * @see https://schema.org/availabilityEnds
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Time')]
    #[ApiProperty(types: ['https://schema.org/availabilityEnds'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $availabilityEnds = null;

    /**
     * @var Collection<Text>|null A category for the item. Greater signs or slashes can be used to informally indicate a category hierarchy.
     *
     * @see https://schema.org/category
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'action_access_specification_text_category')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/category'])]
    private ?Collection $category = null;

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

    /**
     * @var Collection<Text>|null The ISO 3166-1 (ISO 3166-1 alpha-2) or ISO 3166-2 code, the place, or the GeoShape for the geo-political region(s) for which the offer or delivery charge specification is not valid, e.g. a region where the transaction is not allowed.\\n\\nSee also \[\[eligibleRegion\]\].
     *
     * @see https://schema.org/ineligibleRegion
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'action_access_specification_text_ineligible_region')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/ineligibleRegion'])]
    private ?Collection $ineligibleRegion = null;

    /**
     * Indicates if use of the media require a subscription (either paid or free). Allowed values are ```true``` or ```false``` (note that an earlier version had 'yes', 'no').
     *
     * @see https://schema.org/requiresSubscription
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MediaSubscription')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/requiresSubscription'])]
    #[Assert\NotNull]
    private MediaSubscription $requiresSubscription;

    /**
     * @var Collection<GeoShape>|null The ISO 3166-1 (ISO 3166-1 alpha-2) or ISO 3166-2 code, the place, or the GeoShape for the geo-political region(s) for which the offer or delivery charge specification is valid.\\n\\nSee also \[\[ineligibleRegion\]\].
     *
     * @see https://schema.org/eligibleRegion
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\GeoShape')]
    #[ORM\JoinTable(name: 'action_access_specification_geo_shape_eligible_region')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/eligibleRegion'])]
    private ?Collection $eligibleRegion = null;

    /**
     * The beginning of the availability of the product or service included in the offer.
     *
     * @see https://schema.org/availabilityStarts
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/availabilityStarts'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $availabilityStarts = null;

    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->ineligibleRegion = new ArrayCollection();
        $this->eligibleRegion = new ArrayCollection();
    }

    public function setAvailabilityEnds(?\DateTimeInterface $availabilityEnds): void
    {
        $this->availabilityEnds = $availabilityEnds;
    }

    public function getAvailabilityEnds(): ?\DateTimeInterface
    {
        return $this->availabilityEnds;
    }

    public function addCategory(string $category): void
    {
        $this->category[] = $category;
    }

    public function removeCategory(string $category): void
    {
        $this->category->removeElement($category);
    }

    /**
     * @return Collection<Text>|null
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function setExpectsAcceptanceOf(Offer $expectsAcceptanceOf): void
    {
        $this->expectsAcceptanceOf = $expectsAcceptanceOf;
    }

    public function getExpectsAcceptanceOf(): Offer
    {
        return $this->expectsAcceptanceOf;
    }

    public function addIneligibleRegion(string $ineligibleRegion): void
    {
        $this->ineligibleRegion[] = $ineligibleRegion;
    }

    public function removeIneligibleRegion(string $ineligibleRegion): void
    {
        $this->ineligibleRegion->removeElement($ineligibleRegion);
    }

    /**
     * @return Collection<Text>|null
     */
    public function getIneligibleRegion(): Collection
    {
        return $this->ineligibleRegion;
    }

    public function setRequiresSubscription(MediaSubscription $requiresSubscription): void
    {
        $this->requiresSubscription = $requiresSubscription;
    }

    public function getRequiresSubscription(): MediaSubscription
    {
        return $this->requiresSubscription;
    }

    public function addEligibleRegion(GeoShape $eligibleRegion): void
    {
        $this->eligibleRegion[] = $eligibleRegion;
    }

    public function removeEligibleRegion(GeoShape $eligibleRegion): void
    {
        $this->eligibleRegion->removeElement($eligibleRegion);
    }

    /**
     * @return Collection<GeoShape>|null
     */
    public function getEligibleRegion(): Collection
    {
        return $this->eligibleRegion;
    }

    public function setAvailabilityStarts(?\DateTimeInterface $availabilityStarts): void
    {
        $this->availabilityStarts = $availabilityStarts;
    }

    public function getAvailabilityStarts(): ?\DateTimeInterface
    {
        return $this->availabilityStarts;
    }
}
