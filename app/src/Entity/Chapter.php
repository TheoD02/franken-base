<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * One of the sections into which a book is divided. A chapter usually has a section number or a name.
 *
 * @see https://schema.org/Chapter
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Chapter'])]
class Chapter extends CreativeWork
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
}
