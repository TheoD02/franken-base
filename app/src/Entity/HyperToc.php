<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A HyperToc represents a hypertext table of contents for complex media objects, such as \[\[VideoObject\]\], \[\[AudioObject\]\]. Items in the table of contents are indicated using the \[\[tocEntry\]\] property, and typed \[\[HyperTocEntry\]\]. For cases where the same larger work is split into multiple files, \[\[associatedMedia\]\] can be used on individual \[\[HyperTocEntry\]\] items.
 *
 * @see https://schema.org/HyperToc
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/HyperToc'])]
class HyperToc extends CreativeWork
{
    /**
     * Indicates a \[\[HyperTocEntry\]\] in a \[\[HyperToc\]\].
     *
     * @see https://schema.org/tocEntry
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\HyperTocEntry')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/tocEntry'])]
    #[Assert\NotNull]
    private HyperTocEntry $tocEntry;

    public function setTocEntry(HyperTocEntry $tocEntry): void
    {
        $this->tocEntry = $tocEntry;
    }

    public function getTocEntry(): HyperTocEntry
    {
        return $this->tocEntry;
    }
}
