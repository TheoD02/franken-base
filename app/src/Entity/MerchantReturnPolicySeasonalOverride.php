<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Enum\MerchantReturnEnumeration;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A seasonal override of a return policy, for example used for holidays.
 *
 * @see https://schema.org/MerchantReturnPolicySeasonalOverride
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MerchantReturnPolicySeasonalOverride'])]
class MerchantReturnPolicySeasonalOverride extends Intangible
{
    /**
     * Specifies an applicable return policy (from an enumeration).
     *
     * @see https://schema.org/returnPolicyCategory
     */
    #[ORM\Column]
    #[ApiProperty(types: ['https://schema.org/returnPolicyCategory'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [MerchantReturnEnumeration::class, 'toArray'])]
    private string $returnPolicyCategory;

    /**
     * Specifies either a fixed return date or the number of days (from the delivery date) that a product can be returned. Used when the \[\[returnPolicyCategory\]\] property is specified as \[\[MerchantReturnFiniteReturnWindow\]\].
     *
     * @see https://schema.org/merchantReturnDays
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Integer')]
    #[ApiProperty(types: ['https://schema.org/merchantReturnDays'])]
    private ?int $merchantReturnDays = null;

    /**
     * The start date and time of the item (in \[ISO 8601 date format\](http://en.wikipedia.org/wiki/ISO\_8601)).
     *
     * @see https://schema.org/startDate
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/startDate'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $startDate = null;

    /**
     * The end date and time of the item (in \[ISO 8601 date format\](http://en.wikipedia.org/wiki/ISO\_8601)).
     *
     * @see https://schema.org/endDate
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/endDate'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $endDate = null;

    public function setReturnPolicyCategory(string $returnPolicyCategory): void
    {
        $this->returnPolicyCategory = $returnPolicyCategory;
    }

    public function getReturnPolicyCategory(): string
    {
        return $this->returnPolicyCategory;
    }

    public function setMerchantReturnDays(?int $merchantReturnDays): void
    {
        $this->merchantReturnDays = $merchantReturnDays;
    }

    public function getMerchantReturnDays(): ?int
    {
        return $this->merchantReturnDays;
    }

    public function setStartDate(?\DateTimeInterface $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }
}
