<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A medical test performed by a laboratory that typically involves examination of a tissue sample by a pathologist.
 *
 * @see https://schema.org/PathologyTest
 *
 * @internal
 *
 * @coversNothing
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PathologyTest'])]
class PathologyTest extends MedicalTest
{
    /**
     * The type of tissue sample required for the test.
     *
     * @see https://schema.org/tissueSample
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/tissueSample'])]
    private ?string $tissueSample = null;

    public function setTissueSample(?string $tissueSample): void
    {
        $this->tissueSample = $tissueSample;
    }

    public function getTissueSample(): ?string
    {
        return $this->tissueSample;
    }
}
