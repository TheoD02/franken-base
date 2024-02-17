<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A set of Category Code values.
 *
 * @see https://schema.org/CategoryCodeSet
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/CategoryCodeSet'])]
class CategoryCodeSet extends DefinedTermSet
{
    /**
     * A Category code contained in this code set.
     *
     * @see https://schema.org/hasCategoryCode
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\CategoryCode')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/hasCategoryCode'])]
    #[Assert\NotNull]
    private CategoryCode $hasCategoryCode;

    public function setHasCategoryCode(CategoryCode $hasCategoryCode): void
    {
        $this->hasCategoryCode = $hasCategoryCode;
    }

    public function getHasCategoryCode(): CategoryCode
    {
        return $this->hasCategoryCode;
    }
}
