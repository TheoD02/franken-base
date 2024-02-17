<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\Post;
use Doctrine\ORM\Mapping as ORM;

/**
 * A part of a successively published publication such as a periodical or publication volume, often numbered, usually containing a grouping of works such as articles.\\n\\nSee also \[blog post\](http://blog.schema.org/2014/09/schemaorg-support-for-bibliographic\_2.html).
 *
 * @see https://schema.org/PublicationIssue
 */
#[ORM\MappedSuperclass]
abstract class PublicationIssue extends CreativeWork
{
    /**
     * Any description of pages that is not separated into pageStart and pageEnd; for example, "1-6, 9, 55" or "10-12, 46-49".
     *
     * @see https://schema.org/pagination
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/pagination'])]
    private ?string $pagination = null;

    /**
     * The page on which the work ends; for example "138" or "xvi".
     *
     * @see https://schema.org/pageEnd
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
    #[ApiProperty(types: ['https://schema.org/pageEnd'])]
    private ?int $pageEnd = null;

    /**
     * The page on which the work starts; for example "135" or "xiii".
     *
     * @see https://schema.org/pageStart
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
    #[ApiProperty(types: ['https://schema.org/pageStart'])]
    private ?int $pageStart = null;

    /**
     * Identifies the issue of publication; for example, "iii" or "2".
     *
     * @see https://schema.org/issueNumber
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
    #[ApiProperty(types: ['https://schema.org/issueNumber'])]
    private ?int $issueNumber = null;

    public function setPagination(?string $pagination): void
    {
        $this->pagination = $pagination;
    }

    public function getPagination(): ?string
    {
        return $this->pagination;
    }

    public function setPageEnd(?int $pageEnd): void
    {
        $this->pageEnd = $pageEnd;
    }

    public function getPageEnd(): ?int
    {
        return $this->pageEnd;
    }

    public function setPageStart(?int $pageStart): void
    {
        $this->pageStart = $pageStart;
    }

    public function getPageStart(): ?int
    {
        return $this->pageStart;
    }

    public function setIssueNumber(?int $issueNumber): void
    {
        $this->issueNumber = $issueNumber;
    }

    public function getIssueNumber(): ?int
    {
        return $this->issueNumber;
    }
}
