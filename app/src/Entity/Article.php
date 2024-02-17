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
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An article, such as a news article or piece of investigative report. Newspapers and magazines have articles of many different types and this is intended to cover them all.\\n\\nSee also \[blog post\](http://blog.schema.org/2014/09/schemaorg-support-for-bibliographic\_2.html).
 *
 * @see https://schema.org/Article
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
	'article' => Article::class,
	'satiricalArticle' => SatiricalArticle::class,
	'advertiserContentArticle' => AdvertiserContentArticle::class,
	'newsArticle' => NewsArticle::class,
	'report' => Report::class,
	'medicalScholarlyArticle' => MedicalScholarlyArticle::class,
	'APIReference' => APIReference::class,
	'discussionForumPosting' => DiscussionForumPosting::class,
	'blogPosting' => BlogPosting::class,
	'backgroundNewsArticle' => BackgroundNewsArticle::class,
	'reviewNewsArticle' => ReviewNewsArticle::class,
	'opinionNewsArticle' => OpinionNewsArticle::class,
	'askPublicNewsArticle' => AskPublicNewsArticle::class,
	'reportageNewsArticle' => ReportageNewsArticle::class,
	'analysisNewsArticle' => AnalysisNewsArticle::class,
	'liveBlogPosting' => LiveBlogPosting::class,
])]
class Article extends CreativeWork
{
	/**
	 * @var Collection<URL>|null Indicates sections of a Web page that are particularly 'speakable' in the sense of being highlighted as being especially appropriate for text-to-speech conversion. Other sections of a page may also be usefully spoken in particular circumstances; the 'speakable' property serves to indicate the parts most likely to be generally useful for speech. The \*speakable\* property can be repeated an arbitrary number of times, with three kinds of possible 'content-locator' values: 1.) \*id-value\* URL references - uses \*id-value\* of an element in the page being annotated. The simplest use of \*speakable\* has (potentially relative) URL values, referencing identified sections of the document concerned. 2.) CSS Selectors - addresses content in the annotated page, e.g. via class attribute. Use the \[\[cssSelector\]\] property. 3.) XPaths - addresses content via XPaths (assuming an XML view of the content). Use the \[\[xpath\]\] property. For more sophisticated markup of speakable sections beyond simple ID references, either CSS selectors or XPath expressions to pick out document section(s) as speakable. For this we define a supporting type, \[\[SpeakableSpecification\]\] which is defined to be a possible value of the \*speakable\* property.
	 * @see https://schema.org/speakable
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\URL')]
	#[ORM\JoinTable(name: 'article_url_speakable')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/speakable'])]
	private ?Collection $speakable = null;

	/**
	 * The number of words in the text of the Article.
	 *
	 * @see https://schema.org/wordCount
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
	#[ApiProperty(types: ['https://schema.org/wordCount'])]
	private ?int $wordCount = null;

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
	 * For an \[\[Article\]\], typically a \[\[NewsArticle\]\], the backstory property provides a textual summary giving a brief explanation of why and how an article was created. In a journalistic setting this could include information about reporting process, methods, interviews, data sources, etc.
	 *
	 * @see https://schema.org/backstory
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/backstory'])]
	private ?string $backstory = null;

	/**
	 * The page on which the work starts; for example "135" or "xiii".
	 *
	 * @see https://schema.org/pageStart
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
	#[ApiProperty(types: ['https://schema.org/pageStart'])]
	private ?int $pageStart = null;

	/**
	 * The actual body of the article.
	 *
	 * @see https://schema.org/articleBody
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/articleBody'])]
	private ?string $articleBody = null;

	/**
	 * @var Collection<Text>|null Articles may belong to one or more 'sections' in a magazine or newspaper, such as Sports, Lifestyle, etc.
	 * @see https://schema.org/articleSection
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinTable(name: 'article_text_article_section')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/articleSection'])]
	private ?Collection $articleSection = null;

	function __construct()
	{
		parent::__construct();
		$this->speakable = new ArrayCollection();
		$this->articleSection = new ArrayCollection();
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

	public function setWordCount(?int $wordCount): void
	{
		$this->wordCount = $wordCount;
	}

	public function getWordCount(): ?int
	{
		return $this->wordCount;
	}

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

	public function setBackstory(?string $backstory): void
	{
		$this->backstory = $backstory;
	}

	public function getBackstory(): ?string
	{
		return $this->backstory;
	}

	public function setPageStart(?int $pageStart): void
	{
		$this->pageStart = $pageStart;
	}

	public function getPageStart(): ?int
	{
		return $this->pageStart;
	}

	public function setArticleBody(?string $articleBody): void
	{
		$this->articleBody = $articleBody;
	}

	public function getArticleBody(): ?string
	{
		return $this->articleBody;
	}

	public function addArticleSection(string $articleSection): void
	{
		$this->articleSection[] = $articleSection;
	}

	public function removeArticleSection(string $articleSection): void
	{
		$this->articleSection->removeElement($articleSection);
	}

	/**
	 * @return Collection<Text>|null
	 */
	public function getArticleSection(): Collection
	{
		return $this->articleSection;
	}
}
