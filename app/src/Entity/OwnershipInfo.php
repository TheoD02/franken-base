<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A structured value providing information about when a certain organization or person owned a certain product.
 *
 * @see https://schema.org/OwnershipInfo
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/OwnershipInfo'])]
class OwnershipInfo extends StructuredValue
{
    /**
     * The date and time of obtaining the product.
     *
     * @see https://schema.org/ownedFrom
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\DateTime')]
    #[ApiProperty(types: ['https://schema.org/ownedFrom'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $ownedFrom = null;

    /**
     * The organization or person from which the product was acquired.
     *
     * @see https://schema.org/acquiredFrom
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ApiProperty(types: ['https://schema.org/acquiredFrom'])]
    private ?Person $acquiredFrom = null;

    /**
     * The product that this structured value is referring to.
     *
     * @see https://schema.org/typeOfGood
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Product')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/typeOfGood'])]
    #[Assert\NotNull]
    private Product $typeOfGood;

    /**
     * The date and time of giving up ownership on the product.
     *
     * @see https://schema.org/ownedThrough
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\DateTime')]
    #[ApiProperty(types: ['https://schema.org/ownedThrough'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $ownedThrough = null;

    public function setOwnedFrom(?\DateTimeInterface $ownedFrom): void
    {
        $this->ownedFrom = $ownedFrom;
    }

    public function getOwnedFrom(): ?\DateTimeInterface
    {
        return $this->ownedFrom;
    }

    public function setAcquiredFrom(?Person $acquiredFrom): void
    {
        $this->acquiredFrom = $acquiredFrom;
    }

    public function getAcquiredFrom(): ?Person
    {
        return $this->acquiredFrom;
    }

    public function setTypeOfGood(Product $typeOfGood): void
    {
        $this->typeOfGood = $typeOfGood;
    }

    public function getTypeOfGood(): Product
    {
        return $this->typeOfGood;
    }

    public function setOwnedThrough(?\DateTimeInterface $ownedThrough): void
    {
        $this->ownedThrough = $ownedThrough;
    }

    public function getOwnedThrough(): ?\DateTimeInterface
    {
        return $this->ownedThrough;
    }
}
