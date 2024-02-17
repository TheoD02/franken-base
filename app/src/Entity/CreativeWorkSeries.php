<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A CreativeWorkSeries in schema.org is a group of related items, typically but not necessarily of the same kind. CreativeWorkSeries are usually organized into some order, often chronological. Unlike \[\[ItemList\]\] which is a general purpose data structure for lists of things, the emphasis with CreativeWorkSeries is on published materials (written e.g. books and periodicals, or media such as TV, radio and games).\\n\\nSpecific subtypes are available for describing \[\[TVSeries\]\], \[\[RadioSeries\]\], \[\[MovieSeries\]\], \[\[BookSeries\]\], \[\[Periodical\]\] and \[\[VideoGameSeries\]\]. In each case, the \[\[hasPart\]\] / \[\[isPartOf\]\] properties can be used to relate the CreativeWorkSeries to its parts. The general CreativeWorkSeries type serves largely just to organize these more specific and practical subtypes.\\n\\nIt is common for properties applicable to an item from the series to be usefully applied to the containing group. Schema.org attempts to anticipate some of these cases, but publishers should be free to apply properties of the series parts to the series as a whole wherever they seem appropriate.
 *
 * @see https://schema.org/CreativeWorkSeries
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
    'creativeWorkSeries' => CreativeWorkSeries::class,
    'bookSeries' => BookSeries::class,
    'movieSeries' => MovieSeries::class,
    'podcastSeries' => PodcastSeries::class,
    'radioSeries' => RadioSeries::class,
    'videoGameSeries' => VideoGameSeries::class,
    'newspaper' => Newspaper::class,
    'comicSeries' => ComicSeries::class,
])]
class CreativeWorkSeries extends Series
{
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

    /**
     * The International Standard Serial Number (ISSN) that identifies this serial publication. You can repeat this property to identify different formats of, or the linking ISSN (ISSN-L) for, this serial publication.
     *
     * @see https://schema.org/issn
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/issn'])]
    private ?string $issn = null;

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

    public function setIssn(?string $issn): void
    {
        $this->issn = $issn;
    }

    public function getIssn(): ?string
    {
        return $this->issn;
    }
}
