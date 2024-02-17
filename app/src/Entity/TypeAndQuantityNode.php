<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Enum\BusinessFunction;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A structured value indicating the quantity, unit of measurement, and business function of goods included in a bundle offer.
 *
 * @see https://schema.org/TypeAndQuantityNode
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TypeAndQuantityNode'])]
class TypeAndQuantityNode extends StructuredValue
{
    /**
     * @var string[] The business function (e.g. sell, lease, repair, dispose) of the offer or component of a bundle (TypeAndQuantityNode). The default is http://purl.org/goodrelations/v1#Sell.
     *
     * @see https://schema.org/businessFunction
     */
    #[ORM\Column(type: 'simple_array')]
    #[ApiProperty(types: ['https://schema.org/businessFunction'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [BusinessFunction::class, 'toArray'], multiple: true)]
    private Collection $businessFunction;

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
     * The unit of measurement given using the UN/CEFACT Common Code (3 characters) or a URL. Other codes than the UN/CEFACT Common Code may be used with a prefix followed by a colon.
     *
     * @see https://schema.org/unitCode
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/unitCode'])]
    #[Assert\NotNull]
    private string $unitCode;

    /**
     * The quantity of the goods included in the offer.
     *
     * @see https://schema.org/amountOfThisGood
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/amountOfThisGood'])]
    #[Assert\NotNull]
    private string $amountOfThisGood;

    /**
     * A string or text indicating the unit of measurement. Useful if you cannot provide a standard unit code for [unitCode](unitCode).
     *
     * @see https://schema.org/unitText
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/unitText'])]
    private ?string $unitText = null;

    public function addBusinessFunction($businessFunction): void
    {
        $this->businessFunction[] = (string) $businessFunction;
    }

    public function removeBusinessFunction(string $businessFunction): void
    {
        if (false !== $key = array_search((string) $businessFunction, $this->businessFunction, true)) {
            unset($this->businessFunction[$key]);
        }
    }

    /**
     * @return string[]
     */
    public function getBusinessFunction(): Collection
    {
        return $this->businessFunction;
    }

    public function setTypeOfGood(Product $typeOfGood): void
    {
        $this->typeOfGood = $typeOfGood;
    }

    public function getTypeOfGood(): Product
    {
        return $this->typeOfGood;
    }

    public function setUnitCode(string $unitCode): void
    {
        $this->unitCode = $unitCode;
    }

    public function getUnitCode(): string
    {
        return $this->unitCode;
    }

    public function setAmountOfThisGood(string $amountOfThisGood): void
    {
        $this->amountOfThisGood = $amountOfThisGood;
    }

    public function getAmountOfThisGood(): string
    {
        return $this->amountOfThisGood;
    }

    public function setUnitText(?string $unitText): void
    {
        $this->unitText = $unitText;
    }

    public function getUnitText(): ?string
    {
        return $this->unitText;
    }
}
