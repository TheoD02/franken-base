<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Enum\WarrantyScope;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A structured value representing the duration and scope of services that will be provided to a customer free of charge in case of a defect or malfunction of a product.
 *
 * @see https://schema.org/WarrantyPromise
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/WarrantyPromise'])]
class WarrantyPromise extends StructuredValue
{
    /**
     * The duration of the warranty promise. Common unitCode values are ANN for year, MON for months, or DAY for days.
     *
     * @see https://schema.org/durationOfWarranty
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ApiProperty(types: ['https://schema.org/durationOfWarranty'])]
    private ?QuantitativeValue $durationOfWarranty = null;

    /**
     * The scope of the warranty promise.
     *
     * @see https://schema.org/warrantyScope
     */
    #[ORM\Column(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/warrantyScope'])]
    #[Assert\Choice(callback: [WarrantyScope::class, 'toArray'])]
    private ?string $warrantyScope = null;

    public function setDurationOfWarranty(?QuantitativeValue $durationOfWarranty): void
    {
        $this->durationOfWarranty = $durationOfWarranty;
    }

    public function getDurationOfWarranty(): ?QuantitativeValue
    {
        return $this->durationOfWarranty;
    }

    public function setWarrantyScope(?string $warrantyScope): void
    {
        $this->warrantyScope = $warrantyScope;
    }

    public function getWarrantyScope(): ?string
    {
        return $this->warrantyScope;
    }
}
