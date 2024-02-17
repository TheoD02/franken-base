<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Any collection of tests commonly ordered together.
 *
 * @see https://schema.org/MedicalTestPanel
 *
 * @internal
 *
 * @coversNothing
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MedicalTestPanel'])]
class MedicalTestPanel extends MedicalTest
{
    /**
     * A component test of the panel.
     *
     * @see https://schema.org/subTest
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MedicalTest')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/subTest'])]
    #[Assert\NotNull]
    private MedicalTest $subTest;

    public function setSubTest(MedicalTest $subTest): void
    {
        $this->subTest = $subTest;
    }

    public function getSubTest(): MedicalTest
    {
        return $this->subTest;
    }
}
