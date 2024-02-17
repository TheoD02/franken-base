<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;

/**
 * A NewsArticle is an article whose content reports news, or provides background context and supporting materials for understanding the news. A more detailed overview of \[schema.org News markup\](/docs/news.html) is also available.
 *
 * @see https://schema.org/NewsArticle
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
    'newsArticle' => NewsArticle::class,
    'backgroundNewsArticle' => BackgroundNewsArticle::class,
    'reviewNewsArticle' => ReviewNewsArticle::class,
    'opinionNewsArticle' => OpinionNewsArticle::class,
    'askPublicNewsArticle' => AskPublicNewsArticle::class,
    'reportageNewsArticle' => ReportageNewsArticle::class,
    'analysisNewsArticle' => AnalysisNewsArticle::class,
])]
class NewsArticle extends Article
{
    /**
     * A \[dateline\](https://en.wikipedia.org/wiki/Dateline) is a brief piece of text included in news articles that describes where and when the story was written or filed though the date is often omitted. Sometimes only a placename is provided. Structured representations of dateline-related information can also be expressed more explicitly using \[\[locationCreated\]\] (which represents where a work was created, e.g. where a news report was written). For location depicted or described in the content, use \[\[contentLocation\]\]. Dateline summaries are oriented more towards human readers than towards automated processing, and can vary substantially. Some examples: "BEIRUT, Lebanon, June 2.", "Paris, France", "December 19, 2017 11:43AM Reporting from Washington", "Beijing/Moscow", "QUEZON CITY, Philippines".
     *
     * @see https://schema.org/dateline
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/dateline'])]
    private ?string $dateline = null;

    /**
     * The edition of the print product in which the NewsArticle appears.
     *
     * @see https://schema.org/printEdition
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/printEdition'])]
    private ?string $printEdition = null;

    /**
     * The number of the column in which the NewsArticle appears in the print edition.
     *
     * @see https://schema.org/printColumn
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/printColumn'])]
    private ?string $printColumn = null;

    /**
     * If this NewsArticle appears in print, this field indicates the name of the page on which the article is found. Please note that this field is intended for the exact page name (e.g. A5, B18).
     *
     * @see https://schema.org/printPage
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/printPage'])]
    private ?string $printPage = null;

    /**
     * If this NewsArticle appears in print, this field indicates the print section in which the article appeared.
     *
     * @see https://schema.org/printSection
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/printSection'])]
    private ?string $printSection = null;

    public function setDateline(?string $dateline): void
    {
        $this->dateline = $dateline;
    }

    public function getDateline(): ?string
    {
        return $this->dateline;
    }

    public function setPrintEdition(?string $printEdition): void
    {
        $this->printEdition = $printEdition;
    }

    public function getPrintEdition(): ?string
    {
        return $this->printEdition;
    }

    public function setPrintColumn(?string $printColumn): void
    {
        $this->printColumn = $printColumn;
    }

    public function getPrintColumn(): ?string
    {
        return $this->printColumn;
    }

    public function setPrintPage(?string $printPage): void
    {
        $this->printPage = $printPage;
    }

    public function getPrintPage(): ?string
    {
        return $this->printPage;
    }

    public function setPrintSection(?string $printSection): void
    {
        $this->printSection = $printSection;
    }

    public function getPrintSection(): ?string
    {
        return $this->printSection;
    }
}
