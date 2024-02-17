<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A SpecialAnnouncement combines a simple date-stamped textual information update with contextualized Web links and other structured data. It represents an information update made by a locally-oriented organization, for example schools, pharmacies, healthcare providers, community groups, police, local government. For work in progress guidelines on Coronavirus-related markup see \[this doc\](https://docs.google.com/document/d/14ikaGCKxo50rRM7nvKSlbUpjyIk2WMQd3IkB1lItlrM/edit#). The motivating scenario for SpecialAnnouncement is the \[Coronavirus pandemic\](https://en.wikipedia.org/wiki/2019%E2%80%9320\_coronavirus\_pandemic), and the initial vocabulary is oriented to this urgent situation. Schema.org expect to improve the markup iteratively as it is deployed and as feedback emerges from use. In addition to our usual \[Github entry\](https://github.com/schemaorg/schemaorg/issues/2490), feedback comments can also be provided in \[this document\](https://docs.google.com/document/d/1fpdFFxk8s87CWwACs53SGkYv3aafSxz\_DTtOQxMrBJQ/edit#). While this schema is designed to communicate urgent crisis-related information, it is not the same as an emergency warning technology like \[CAP\](https://en.wikipedia.org/wiki/Common\_Alerting\_Protocol), although there may be overlaps. The intent is to cover the kinds of everyday practical information being posted to existing websites during an emergency situation. Several kinds of information can be provided: We encourage the provision of "name", "text", "datePosted", "expires" (if appropriate), "category" and "url" as a simple baseline. It is important to provide a value for "category" where possible, most ideally as a well known URL from Wikipedia or Wikidata. In the case of the 2019-2020 Coronavirus pandemic, this should be "https://en.wikipedia.org/w/index.php?title=2019-20\\\_coronavirus\\\_pandemic" or "https://www.wikidata.org/wiki/Q81068910". For many of the possible properties, values can either be simple links or an inline description, depending on whether a summary is available. For a link, provide just the URL of the appropriate page as the property's value. For an inline description, use a \[\[WebContent\]\] type, and provide the url as a property of that, alongside at least a simple "\[\[text\]\]" summary of the page. It is unlikely that a single SpecialAnnouncement will need all of the possible properties simultaneously. We expect that in many cases the page referenced might contain more specialized structured data, e.g. contact info, \[\[openingHours\]\], \[\[Event\]\], \[\[FAQPage\]\] etc. By linking to those pages from a \[\[SpecialAnnouncement\]\] you can help make it clearer that the events are related to the situation (e.g. Coronavirus) indicated by the \[\[category\]\] property of the \[\[SpecialAnnouncement\]\]. Many \[\[SpecialAnnouncement\]\]s will relate to particular regions and to identifiable local organizations. Use \[\[spatialCoverage\]\] for the region, and \[\[announcementLocation\]\] to indicate specific \[\[LocalBusiness\]\]es and \[\[CivicStructure\]\]s. If the announcement affects both a particular region and a specific location (for example, a library closure that serves an entire region), use both \[\[spatialCoverage\]\] and \[\[announcementLocation\]\]. The \[\[about\]\] property can be used to indicate entities that are the focus of the announcement. We now recommend using \[\[about\]\] only for representing non-location entities (e.g. a \[\[Course\]\] or a \[\[RadioStation\]\]). For places, use \[\[announcementLocation\]\] and \[\[spatialCoverage\]\]. Consumers of this markup should be aware that the initial design encouraged the use of \[\[about\]\] for locations too. The basic content of \[\[SpecialAnnouncement\]\] is similar to that of an \[RSS\](https://en.wikipedia.org/wiki/RSS) or \[Atom\](https://en.wikipedia.org/wiki/Atom\_(Web\_standard)) feed. For publishers without such feeds, basic feed-like information can be shared by posting \[\[SpecialAnnouncement\]\] updates in a page, e.g. using JSON-LD. For sites with Atom/RSS functionality, you can point to a feed with the \[\[webFeed\]\] property. This can be a simple URL, or an inline \[\[DataFeed\]\] object, with \[\[encodingFormat\]\] providing media type information, e.g. "application/rss+xml" or "application/atom+xml".
 *
 * @see https://schema.org/SpecialAnnouncement
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SpecialAnnouncement'])]
class SpecialAnnouncement extends CreativeWork
{
    /**
     * Publication date of an online listing.
     *
     * @see https://schema.org/datePosted
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/datePosted'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $datePosted = null;

    /**
     * Indicates a specific \[\[CivicStructure\]\] or \[\[LocalBusiness\]\] associated with the SpecialAnnouncement. For example, a specific testing facility or business with special opening hours. For a larger geographic region like a quarantine of an entire region, use \[\[spatialCoverage\]\].
     *
     * @see https://schema.org/announcementLocation
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\CivicStructure')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/announcementLocation'])]
    #[Assert\NotNull]
    private CivicStructure $announcementLocation;

    /**
     * @var Collection<Text>|null A category for the item. Greater signs or slashes can be used to informally indicate a category hierarchy.
     *
     * @see https://schema.org/category
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'special_announcement_text_category')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/category'])]
    private ?Collection $category = null;

    /**
     * Indicates a page with news updates and guidelines. This could often be (but is not required to be) the main page containing \[\[SpecialAnnouncement\]\] markup on a site.
     *
     * @see https://schema.org/newsUpdatesAndGuidelines
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\WebContent')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/newsUpdatesAndGuidelines'])]
    #[Assert\NotNull]
    private WebContent $newsUpdatesAndGuidelines;

    /**
     * Information about school closures.
     *
     * @see https://schema.org/schoolClosuresInfo
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\WebContent')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/schoolClosuresInfo'])]
    #[Assert\NotNull]
    private WebContent $schoolClosuresInfo;

    /**
     * Information about public transport closures.
     *
     * @see https://schema.org/publicTransportClosuresInfo
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
    #[ApiProperty(types: ['https://schema.org/publicTransportClosuresInfo'])]
    #[Assert\Url]
    private ?string $publicTransportClosuresInfo = null;

    /**
     * governmentBenefitsInfo provides information about government benefits associated with a SpecialAnnouncement.
     *
     * @see https://schema.org/governmentBenefitsInfo
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\GovernmentService')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/governmentBenefitsInfo'])]
    #[Assert\NotNull]
    private GovernmentService $governmentBenefitsInfo;

    /**
     * The URL for a feed, e.g. associated with a podcast series, blog, or series of date-stamped updates. This is usually RSS or Atom.
     *
     * @see https://schema.org/webFeed
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\DataFeed')]
    #[ApiProperty(types: ['https://schema.org/webFeed'])]
    private ?DataFeed $webFeed = null;

    /**
     * Statistical information about the spread of a disease, either as \[\[WebContent\]\], or described directly as a \[\[Dataset\]\], or the specific \[\[Observation\]\]s in the dataset. When a \[\[WebContent\]\] URL is provided, the page indicated might also contain more such markup.
     *
     * @see https://schema.org/diseaseSpreadStatistics
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
    #[ApiProperty(types: ['https://schema.org/diseaseSpreadStatistics'])]
    #[Assert\Url]
    private ?string $diseaseSpreadStatistics = null;

    /**
     * Information about travel bans, e.g. in the context of a pandemic.
     *
     * @see https://schema.org/travelBans
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\WebContent')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/travelBans'])]
    #[Assert\NotNull]
    private WebContent $travelBans;

    /**
     * Information about disease prevention.
     *
     * @see https://schema.org/diseasePreventionInfo
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\WebContent')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/diseasePreventionInfo'])]
    #[Assert\NotNull]
    private WebContent $diseasePreventionInfo;

    /**
     * Information about getting tested (for a \[\[MedicalCondition\]\]), e.g. in the context of a pandemic.
     *
     * @see https://schema.org/gettingTestedInfo
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\WebContent')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/gettingTestedInfo'])]
    #[Assert\NotNull]
    private WebContent $gettingTestedInfo;

    /**
     * Guidelines about quarantine rules, e.g. in the context of a pandemic.
     *
     * @see https://schema.org/quarantineGuidelines
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\WebContent')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/quarantineGuidelines'])]
    #[Assert\NotNull]
    private WebContent $quarantineGuidelines;

    public function __construct()
    {
        parent::__construct();
        $this->category = new ArrayCollection();
    }

    public function setDatePosted(?\DateTimeInterface $datePosted): void
    {
        $this->datePosted = $datePosted;
    }

    public function getDatePosted(): ?\DateTimeInterface
    {
        return $this->datePosted;
    }

    public function setAnnouncementLocation(CivicStructure $announcementLocation): void
    {
        $this->announcementLocation = $announcementLocation;
    }

    public function getAnnouncementLocation(): CivicStructure
    {
        return $this->announcementLocation;
    }

    public function addCategory(string $category): void
    {
        $this->category[] = $category;
    }

    public function removeCategory(string $category): void
    {
        $this->category->removeElement($category);
    }

    /**
     * @return Collection<Text>|null
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function setNewsUpdatesAndGuidelines(WebContent $newsUpdatesAndGuidelines): void
    {
        $this->newsUpdatesAndGuidelines = $newsUpdatesAndGuidelines;
    }

    public function getNewsUpdatesAndGuidelines(): WebContent
    {
        return $this->newsUpdatesAndGuidelines;
    }

    public function setSchoolClosuresInfo(WebContent $schoolClosuresInfo): void
    {
        $this->schoolClosuresInfo = $schoolClosuresInfo;
    }

    public function getSchoolClosuresInfo(): WebContent
    {
        return $this->schoolClosuresInfo;
    }

    public function setPublicTransportClosuresInfo(?string $publicTransportClosuresInfo): void
    {
        $this->publicTransportClosuresInfo = $publicTransportClosuresInfo;
    }

    public function getPublicTransportClosuresInfo(): ?string
    {
        return $this->publicTransportClosuresInfo;
    }

    public function setGovernmentBenefitsInfo(GovernmentService $governmentBenefitsInfo): void
    {
        $this->governmentBenefitsInfo = $governmentBenefitsInfo;
    }

    public function getGovernmentBenefitsInfo(): GovernmentService
    {
        return $this->governmentBenefitsInfo;
    }

    public function setWebFeed(?DataFeed $webFeed): void
    {
        $this->webFeed = $webFeed;
    }

    public function getWebFeed(): ?DataFeed
    {
        return $this->webFeed;
    }

    public function setDiseaseSpreadStatistics(?string $diseaseSpreadStatistics): void
    {
        $this->diseaseSpreadStatistics = $diseaseSpreadStatistics;
    }

    public function getDiseaseSpreadStatistics(): ?string
    {
        return $this->diseaseSpreadStatistics;
    }

    public function setTravelBans(WebContent $travelBans): void
    {
        $this->travelBans = $travelBans;
    }

    public function getTravelBans(): WebContent
    {
        return $this->travelBans;
    }

    public function setDiseasePreventionInfo(WebContent $diseasePreventionInfo): void
    {
        $this->diseasePreventionInfo = $diseasePreventionInfo;
    }

    public function getDiseasePreventionInfo(): WebContent
    {
        return $this->diseasePreventionInfo;
    }

    public function setGettingTestedInfo(WebContent $gettingTestedInfo): void
    {
        $this->gettingTestedInfo = $gettingTestedInfo;
    }

    public function getGettingTestedInfo(): WebContent
    {
        return $this->gettingTestedInfo;
    }

    public function setQuarantineGuidelines(WebContent $quarantineGuidelines): void
    {
        $this->quarantineGuidelines = $quarantineGuidelines;
    }

    public function getQuarantineGuidelines(): WebContent
    {
        return $this->quarantineGuidelines;
    }
}
