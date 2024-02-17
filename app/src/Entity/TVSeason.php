<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Season dedicated to TV broadcast and associated online delivery.
 *
 * @see https://schema.org/TVSeason
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TVSeason'])]
class TVSeason extends CreativeWorkSeason
{
    /**
     * An \[EIDR\](https://eidr.org/) (Entertainment Identifier Registry) \[\[identifier\]\] representing at the most general/abstract level, a work of film or television. For example, the motion picture known as "Ghostbusters" has a titleEIDR of "10.5240/7EC7-228A-510A-053E-CBB8-J". This title (or work) may have several variants, which EIDR calls "edits". See \[\[editEIDR\]\]. Since schema.org types like \[\[Movie\]\], \[\[TVEpisode\]\], \[\[TVSeason\]\], and \[\[TVSeries\]\] can be used for both works and their multiple expressions, it is possible to use \[\[titleEIDR\]\] alone (for a general description), or alongside \[\[editEIDR\]\] for a more edit-specific description.
     *
     * @see https://schema.org/titleEIDR
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/titleEIDR'])]
    private ?string $titleEIDR = null;

    public function setTitleEIDR(?string $titleEIDR): void
    {
        $this->titleEIDR = $titleEIDR;
    }

    public function getTitleEIDR(): ?string
    {
        return $this->titleEIDR;
    }
}
