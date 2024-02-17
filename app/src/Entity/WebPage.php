<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Enum\Specialty;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A web page. Every web page is implicitly assumed to be declared to be of type WebPage, so the various properties about that webpage, such as `breadcrumb` may be used. We recommend explicit declaration if these properties are specified, but if they are found outside of an itemscope, they will be assumed to be about the page.
 *
 * @see https://schema.org/WebPage
 */
#[ORM\MappedSuperclass]
abstract class WebPage extends CreativeWork
{
	/**
	 * Date on which the content on this web page was last reviewed for accuracy and/or completeness.
	 *
	 * @see https://schema.org/lastReviewed
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Date')]
	#[ApiProperty(types: ['https://schema.org/lastReviewed'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $lastReviewed = null;

	/**
	 * @var Collection<URL>|null Indicates sections of a Web page that are particularly 'speakable' in the sense of being highlighted as being especially appropriate for text-to-speech conversion. Other sections of a page may also be usefully spoken in particular circumstances; the 'speakable' property serves to indicate the parts most likely to be generally useful for speech. The \*speakable\* property can be repeated an arbitrary number of times, with three kinds of possible 'content-locator' values: 1.) \*id-value\* URL references - uses \*id-value\* of an element in the page being annotated. The simplest use of \*speakable\* has (potentially relative) URL values, referencing identified sections of the document concerned. 2.) CSS Selectors - addresses content in the annotated page, e.g. via class attribute. Use the \[\[cssSelector\]\] property. 3.) XPaths - addresses content via XPaths (assuming an XML view of the content). Use the \[\[xpath\]\] property. For more sophisticated markup of speakable sections beyond simple ID references, either CSS selectors or XPath expressions to pick out document section(s) as speakable. For this we define a supporting type, \[\[SpeakableSpecification\]\] which is defined to be a possible value of the \*speakable\* property.
	 * @see https://schema.org/speakable
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\URL')]
	#[ORM\JoinTable(name: 'web_page_url_speakable')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/speakable'])]
	private ?Collection $speakable = null;

	/**
	 * A link related to this web page, for example to other related web pages.
	 *
	 * @see https://schema.org/relatedLink
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/relatedLink'])]
	#[Assert\Url]
	private ?string $relatedLink = null;

	/**
	 * One of the domain specialities to which this web page's content applies.
	 *
	 * @see https://schema.org/specialty
	 */
	#[ORM\Column]
	#[ApiProperty(types: ['https://schema.org/specialty'])]
	#[Assert\NotNull]
	#[Assert\Choice(callback: [Specialty::class, 'toArray'])]
	private string $specialty;

	/**
	 * A set of links that can help a user understand and navigate a website hierarchy.
	 *
	 * @see https://schema.org/breadcrumb
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\BreadcrumbList')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/breadcrumb'])]
	#[Assert\NotNull]
	private BreadcrumbList $breadcrumb;

	/**
	 * One of the more significant URLs on the page. Typically, these are the non-navigation links that are clicked on the most.
	 *
	 * @see https://schema.org/significantLink
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/significantLink'])]
	#[Assert\Url]
	private ?string $significantLink = null;

	/**
	 * Indicates if this web page element is the main subject of the page.
	 *
	 * @see https://schema.org/mainContentOfPage
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\WebPageElement')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/mainContentOfPage'])]
	#[Assert\NotNull]
	private WebPageElement $mainContentOfPage;

	/**
	 * Indicates the main image on the page.
	 *
	 * @see https://schema.org/primaryImageOfPage
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\ImageObject')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/primaryImageOfPage'])]
	#[Assert\NotNull]
	private ImageObject $primaryImageOfPage;

	/**
	 * People or organizations that have reviewed the content on this web page for accuracy and/or completeness.
	 *
	 * @see https://schema.org/reviewedBy
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/reviewedBy'])]
	#[Assert\NotNull]
	private Person $reviewedBy;

	function __construct()
	{
		parent::__construct();
		$this->speakable = new ArrayCollection();
	}

	public function setLastReviewed(?\DateTimeInterface $lastReviewed): void
	{
		$this->lastReviewed = $lastReviewed;
	}

	public function getLastReviewed(): ?\DateTimeInterface
	{
		return $this->lastReviewed;
	}

	public function addSpeakable(string $speakable): void
	{
		$this->speakable[] = $speakable;
	}

	public function removeSpeakable(string $speakable): void
	{
		$this->speakable->removeElement($speakable);
	}

	/**
	 * @return Collection<URL>|null
	 */
	public function getSpeakable(): Collection
	{
		return $this->speakable;
	}

	public function setRelatedLink(?string $relatedLink): void
	{
		$this->relatedLink = $relatedLink;
	}

	public function getRelatedLink(): ?string
	{
		return $this->relatedLink;
	}

	public function setSpecialty(string $specialty): void
	{
		$this->specialty = $specialty;
	}

	public function getSpecialty(): string
	{
		return $this->specialty;
	}

	public function setBreadcrumb(BreadcrumbList $breadcrumb): void
	{
		$this->breadcrumb = $breadcrumb;
	}

	public function getBreadcrumb(): BreadcrumbList
	{
		return $this->breadcrumb;
	}

	public function setSignificantLink(?string $significantLink): void
	{
		$this->significantLink = $significantLink;
	}

	public function getSignificantLink(): ?string
	{
		return $this->significantLink;
	}

	public function setMainContentOfPage(WebPageElement $mainContentOfPage): void
	{
		$this->mainContentOfPage = $mainContentOfPage;
	}

	public function getMainContentOfPage(): WebPageElement
	{
		return $this->mainContentOfPage;
	}

	public function setPrimaryImageOfPage(ImageObject $primaryImageOfPage): void
	{
		$this->primaryImageOfPage = $primaryImageOfPage;
	}

	public function getPrimaryImageOfPage(): ImageObject
	{
		return $this->primaryImageOfPage;
	}

	public function setReviewedBy(Person $reviewedBy): void
	{
		$this->reviewedBy = $reviewedBy;
	}

	public function getReviewedBy(): Person
	{
		return $this->reviewedBy;
	}
}
