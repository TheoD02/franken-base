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
use App\Enum\IPTCDigitalSourceEnumeration;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The most generic kind of creative work, including books, movies, photographs, software programs, etc.
 *
 * @see https://schema.org/CreativeWork
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
	'creativeWork' => CreativeWork::class,
	'shortStory' => ShortStory::class,
	'atlas' => Atlas::class,
	'sculpture' => Sculpture::class,
	'play' => Play::class,
	'statement' => Statement::class,
	'howToTip' => HowToTip::class,
	'drawing' => Drawing::class,
	'manuscript' => Manuscript::class,
	'painting' => Painting::class,
	'conversation' => Conversation::class,
	'code' => Code::class,
	'sheetMusic' => SheetMusic::class,
	'poster' => Poster::class,
	'season' => Season::class,
	'specialAnnouncement' => SpecialAnnouncement::class,
	'exercisePlan' => ExercisePlan::class,
	'howToSection' => HowToSection::class,
	'dataCatalog' => DataCatalog::class,
	'episode' => Episode::class,
	'legislation' => Legislation::class,
	'musicRecording' => MusicRecording::class,
	'movie' => Movie::class,
	'mediaReviewItem' => MediaReviewItem::class,
	'game' => Game::class,
	'dataset' => Dataset::class,
	'mediaObject' => MediaObject::class,
	'musicComposition' => MusicComposition::class,
	'creativeWorkSeason' => CreativeWorkSeason::class,
	'comicStory' => ComicStory::class,
	'educationalOccupationalCredential' => EducationalOccupationalCredential::class,
	'hyperTocEntry' => HyperTocEntry::class,
	'archiveComponent' => ArchiveComponent::class,
	'musicPlaylist' => MusicPlaylist::class,
	'hyperToc' => HyperToc::class,
	'chapter' => Chapter::class,
	'howToStep' => HowToStep::class,
	'claim' => Claim::class,
	'TVSeries' => TVSeries::class,
	'webContent' => WebContent::class,
	'publicationVolume' => PublicationVolume::class,
	'comment' => Comment::class,
	'webSite' => WebSite::class,
	'mathSolver' => MathSolver::class,
	'map' => Map::class,
	'guide' => Guide::class,
	'quotation' => Quotation::class,
	'review' => Review::class,
	'photograph' => Photograph::class,
	'webPageElement' => WebPageElement::class,
	'menu' => Menu::class,
	'thesis' => Thesis::class,
	'article' => Article::class,
	'softwareApplication' => SoftwareApplication::class,
	'menuSection' => MenuSection::class,
	'diet' => Diet::class,
	'softwareSourceCode' => SoftwareSourceCode::class,
	'certification' => Certification::class,
	'blog' => Blog::class,
	'radioEpisode' => RadioEpisode::class,
	'podcastEpisode' => PodcastEpisode::class,
	'TVEpisode' => TVEpisode::class,
	'legislationObject' => LegislationObject::class,
	'quiz' => Quiz::class,
	'syllabus' => Syllabus::class,
	'course' => Course::class,
	'comicIssue' => ComicIssue::class,
	'dataFeed' => DataFeed::class,
	'musicVideoObject' => MusicVideoObject::class,
	'ampStory' => AmpStory::class,
	'dataDownload' => DataDownload::class,
	'audioObject' => AudioObject::class,
	'videoObject' => VideoObject::class,
	'3DModel' => 3DModel::class,
	'textObject' => TextObject::class,
	'imageObject' => ImageObject::class,
	'podcastSeason' => PodcastSeason::class,
	'radioSeason' => RadioSeason::class,
	'TVSeason' => TVSeason::class,
	'productCollection' => ProductCollection::class,
	'musicRelease' => MusicRelease::class,
	'musicAlbum' => MusicAlbum::class,
	'videoGameClip' => VideoGameClip::class,
	'movieClip' => MovieClip::class,
	'radioClip' => RadioClip::class,
	'TVClip' => TVClip::class,
	'recipe' => Recipe::class,
	'healthTopicContent' => HealthTopicContent::class,
	'correctionComment' => CorrectionComment::class,
	'answer' => Answer::class,
	'question' => Question::class,
	'emailMessage' => EmailMessage::class,
	'userReview' => UserReview::class,
	'employerReview' => EmployerReview::class,
	'claimReview' => ClaimReview::class,
	'criticReview' => CriticReview::class,
	'mediaReview' => MediaReview::class,
	'recommendation' => Recommendation::class,
	'siteNavigationElement' => SiteNavigationElement::class,
	'WPAdBlock' => WPAdBlock::class,
	'WPSideBar' => WPSideBar::class,
	'WPHeader' => WPHeader::class,
	'WPFooter' => WPFooter::class,
	'table' => Table::class,
	'audiobook' => Audiobook::class,
	'satiricalArticle' => SatiricalArticle::class,
	'advertiserContentArticle' => AdvertiserContentArticle::class,
	'newsArticle' => NewsArticle::class,
	'report' => Report::class,
	'noteDigitalDocument' => NoteDigitalDocument::class,
	'textDigitalDocument' => TextDigitalDocument::class,
	'presentationDigitalDocument' => PresentationDigitalDocument::class,
	'spreadsheetDigitalDocument' => SpreadsheetDigitalDocument::class,
	'videoGame' => VideoGame::class,
	'webApplication' => WebApplication::class,
	'mobileApplication' => MobileApplication::class,
	'categoryCodeSet' => CategoryCodeSet::class,
	'contactPage' => ContactPage::class,
	'FAQPage' => FAQPage::class,
	'profilePage' => ProfilePage::class,
	'itemPage' => ItemPage::class,
	'QAPage' => QAPage::class,
	'checkoutPage' => CheckoutPage::class,
	'searchResultsPage' => SearchResultsPage::class,
	'realEstateListing' => RealEstateListing::class,
	'aboutPage' => AboutPage::class,
	'medicalWebPage' => MedicalWebPage::class,
	'comicCoverArt' => ComicCoverArt::class,
	'completeDataFeed' => CompleteDataFeed::class,
	'audioObjectSnapshot' => AudioObjectSnapshot::class,
	'videoObjectSnapshot' => VideoObjectSnapshot::class,
	'barcode' => Barcode::class,
	'imageObjectSnapshot' => ImageObjectSnapshot::class,
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
	'imageGallery' => ImageGallery::class,
	'videoGallery' => VideoGallery::class,
])]
class CreativeWork extends Thing
{
	/**
	 * Indicates an item or CreativeWork that is part of this item, or CreativeWork (in some sense).
	 *
	 * @see https://schema.org/hasPart
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWork')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/hasPart'])]
	#[Assert\NotNull]
	private CreativeWork $hasPart;

	/**
	 * The purpose of a work in the context of education; for example, 'assignment', 'group work'.
	 *
	 * @see https://schema.org/educationalUse
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/educationalUse'])]
	private ?string $educationalUse = null;

	/**
	 * A media object that encodes this CreativeWork. This property is a synonym for associatedMedia.
	 *
	 * @see https://schema.org/encoding
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MediaObject')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/encoding'])]
	#[Assert\NotNull]
	private MediaObject $encoding;

	/**
	 * The human sensory perceptual system or cognitive faculty through which a person may process or perceive information. Values should be drawn from the \[approved vocabulary\](https://www.w3.org/2021/a11y-discov-vocab/latest/#accessMode-vocabulary).
	 *
	 * @see https://schema.org/accessMode
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/accessMode'])]
	private ?string $accessMode = null;

	/**
	 * The publishingPrinciples property indicates (typically via \[\[URL\]\]) a document describing the editorial principles of an \[\[Organization\]\] (or individual, e.g. a \[\[Person\]\] writing a blog) that relate to their activities as a publisher, e.g. ethics or diversity policies. When applied to a \[\[CreativeWork\]\] (e.g. \[\[NewsArticle\]\]) the principles are those of the party primarily responsible for the creation of the \[\[CreativeWork\]\]. While such policies are most typically expressed in natural language, sometimes related information (e.g. indicating a \[\[funder\]\]) can be expressed using schema.org terminology.
	 *
	 * @see https://schema.org/publishingPrinciples
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/publishingPrinciples'])]
	#[Assert\Url]
	private ?string $publishingPrinciples = null;

	/**
	 * The language of the content or performance or used in an action. Please use one of the language codes from the \[IETF BCP 47 standard\](http://tools.ietf.org/html/bcp47). See also \[\[availableLanguage\]\].
	 *
	 * @see https://schema.org/inLanguage
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/inLanguage'])]
	private ?string $inLanguage = null;

	/**
	 * Example/instance/realization/derivation of the concept of this creative work. E.g. the paperback edition, first edition, or e-book.
	 *
	 * @see https://schema.org/workExample
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWork')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/workExample'])]
	#[Assert\NotNull]
	private CreativeWork $workExample;

	/**
	 * The service provider, service operator, or service performer; the goods producer. Another party (a seller) may offer those services or goods on behalf of the provider. A provider may also serve as the seller.
	 *
	 * @see https://schema.org/provider
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ApiProperty(types: ['https://schema.org/provider'])]
	private ?Person $provider = null;

	/**
	 * Organization or person who adapts a creative work to different languages, regional differences and technical requirements of a target market, or that translates during some event.
	 *
	 * @see https://schema.org/translator
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/translator'])]
	#[Assert\NotNull]
	private Person $translator;

	/**
	 * A person or organization that supports (sponsors) something through some kind of financial contribution.
	 *
	 * @see https://schema.org/funder
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/funder'])]
	#[Assert\NotNull]
	private Organization $funder;

	/**
	 * A person or organization that supports a thing through a pledge, promise, or financial contribution. E.g. a sponsor of a Medical Study or a corporate sponsor of an event.
	 *
	 * @see https://schema.org/sponsor
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/sponsor'])]
	#[Assert\NotNull]
	private Organization $sponsor;

	/**
	 * A characteristic of the described resource that is physiologically dangerous to some users. Related to WCAG 2.0 guideline 2.3. Values should be drawn from the \[approved vocabulary\](https://www.w3.org/2021/a11y-discov-vocab/latest/#accessibilityHazard-vocabulary).
	 *
	 * @see https://schema.org/accessibilityHazard
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/accessibilityHazard'])]
	private ?string $accessibilityHazard = null;

	/**
	 * Indicates that the resource is compatible with the referenced accessibility API. Values should be drawn from the \[approved vocabulary\](https://www.w3.org/2021/a11y-discov-vocab/latest/#accessibilityAPI-vocabulary).
	 *
	 * @see https://schema.org/accessibilityAPI
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/accessibilityAPI'])]
	private ?string $accessibilityAPI = null;

	/**
	 * A standardized size of a product or creative work, specified either through a simple textual string (for example 'XL', '32Wx34L'), a QuantitativeValue with a unitCode, or a comprehensive and structured \[\[SizeSpecification\]\]; in other cases, the \[\[width\]\], \[\[height\]\], \[\[depth\]\] and \[\[weight\]\] properties may be more applicable.
	 *
	 * @see https://schema.org/size
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/size'])]
	private ?string $size = null;

	/**
	 * The publisher of the creative work.
	 *
	 * @see https://schema.org/publisher
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ApiProperty(types: ['https://schema.org/publisher'])]
	private ?Organization $publisher = null;

	/**
	 * The date on which the CreativeWork was most recently modified or when the item's entry was modified within a DataFeed.
	 *
	 * @see https://schema.org/dateModified
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
	#[ApiProperty(types: ['https://schema.org/dateModified'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $dateModified = null;

	/**
	 * Indicates (by URL or string) a particular version of a schema used in some CreativeWork. This property was created primarily to indicate the use of a specific schema.org release, e.g. ```10.0``` as a simple string, or more explicitly via URL, ```https://schema.org/docs/releases.html#v10.0```. There may be situations in which other schemas might usefully be referenced this way, e.g. ```http://dublincore.org/specifications/dublin-core/dces/1999-07-02/``` but this has not been carefully explored in the community.
	 *
	 * @see https://schema.org/schemaVersion
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/schemaVersion'])]
	private ?string $schemaVersion = null;

	/**
	 * A license document that applies to this content, typically indicated by URL.
	 *
	 * @see https://schema.org/license
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/license'])]
	#[Assert\Url]
	private ?string $license = null;

	/**
	 * A resource from which this work is derived or from which it is a modification or adaptation.
	 *
	 * @see https://schema.org/isBasedOn
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Product')]
	#[ApiProperty(types: ['https://schema.org/isBasedOn'])]
	private ?Product $isBasedOn = null;

	/**
	 * The position of an item in a series or sequence of items.
	 *
	 * @see https://schema.org/position
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
	#[ApiProperty(types: ['https://schema.org/position'])]
	private ?int $position = null;

	/**
	 * The place and time the release was issued, expressed as a PublicationEvent.
	 *
	 * @see https://schema.org/releasedEvent
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\PublicationEvent')]
	#[ApiProperty(types: ['https://schema.org/releasedEvent'])]
	private ?PublicationEvent $releasedEvent = null;

	/**
	 * @var Collection<Place>|null The spatialCoverage of a CreativeWork indicates the place(s) which are the focus of the content. It is a subproperty of contentLocation intended primarily for more technical and detailed materials. For example with a Dataset, it indicates areas that the dataset describes: a dataset of New York weather would have spatialCoverage which was the place: the state of New York.
	 * @see https://schema.org/spatialCoverage
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Place')]
	#[ORM\JoinTable(name: 'creative_work_place_spatial_coverage')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/spatialCoverage'])]
	private ?Collection $spatialCoverage = null;

	/**
	 * The creator/author of this CreativeWork. This is the same as the Author property for CreativeWork.
	 *
	 * @see https://schema.org/creator
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ApiProperty(types: ['https://schema.org/creator'])]
	private ?Organization $creator = null;

	/**
	 * Approximate or typical time it usually takes to work with or through the content of this work for the typical or target audience.
	 *
	 * @see https://schema.org/timeRequired
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Duration')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/timeRequired'])]
	#[Assert\NotNull]
	private Duration $timeRequired;

	/**
	 * Indicates an item or CreativeWork that this item, or CreativeWork (in some sense), is part of.
	 *
	 * @see https://schema.org/isPartOf
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/isPartOf'])]
	#[Assert\Url]
	private ?string $isPartOf = null;

	/**
	 * Fictional person connected with a creative work.
	 *
	 * @see https://schema.org/character
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/character'])]
	#[Assert\NotNull]
	private Person $character;

	/**
	 * The version of the CreativeWork embodied by a specified resource.
	 *
	 * @see https://schema.org/version
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/version'])]
	private ?string $version = null;

	/**
	 * Date the content expires and is no longer useful or available. For example a \[\[VideoObject\]\] or \[\[NewsArticle\]\] whose availability or relevance is time-limited, a \[\[ClaimReview\]\] fact check whose publisher wants to indicate that it may no longer be relevant (or helpful to highlight) after some date, or a \[\[Certification\]\] the validity has expired.
	 *
	 * @see https://schema.org/expires
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Date')]
	#[ApiProperty(types: ['https://schema.org/expires'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $expires = null;

	/**
	 * Indicates a page or other link involved in archival of a \[\[CreativeWork\]\]. In the case of \[\[MediaReview\]\], the items in a \[\[MediaReviewItem\]\] may often become inaccessible, but be archived by archival, journalistic, activist, or law enforcement organizations. In such cases, the referenced page may not directly publish the content.
	 *
	 * @see https://schema.org/archivedAt
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/archivedAt'])]
	#[Assert\Url]
	private ?string $archivedAt = null;

	/**
	 * Identifies input methods that are sufficient to fully control the described resource. Values should be drawn from the \[approved vocabulary\](https://www.w3.org/2021/a11y-discov-vocab/latest/#accessibilityControl-vocabulary).
	 *
	 * @see https://schema.org/accessibilityControl
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/accessibilityControl'])]
	private ?string $accessibilityControl = null;

	/**
	 * A maintainer of a \[\[Dataset\]\], software package (\[\[SoftwareApplication\]\]), or other \[\[Project\]\]. A maintainer is a \[\[Person\]\] or \[\[Organization\]\] that manages contributions to, and/or publication of, some (typically complex) artifact. It is common for distributions of software and data to be based on "upstream" sources. When \[\[maintainer\]\] is applied to a specific version of something e.g. a particular version or packaging of a \[\[Dataset\]\], it is always possible that the upstream source has a different maintainer. The \[\[isBasedOn\]\] property can be used to indicate such relationships between datasets to make the different maintenance roles clear. Similarly in the case of software, a package may have dedicated maintainers working on integration into software distributions such as Ubuntu, as well as upstream maintainers of the underlying work.
	 *
	 * @see https://schema.org/maintainer
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/maintainer'])]
	#[Assert\NotNull]
	private Organization $maintainer;

	/**
	 * The "spatial" property can be used in cases when more specific properties (e.g. \[\[locationCreated\]\], \[\[spatialCoverage\]\], \[\[contentLocation\]\]) are not known to be appropriate.
	 *
	 * @see https://schema.org/spatial
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Place')]
	#[ApiProperty(types: ['https://schema.org/spatial'])]
	private ?Place $spatial = null;

	/**
	 * Indicates a page documenting how licenses can be purchased or otherwise acquired, for the current item.
	 *
	 * @see https://schema.org/acquireLicensePage
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWork')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/acquireLicensePage'])]
	#[Assert\NotNull]
	private CreativeWork $acquireLicensePage;

	/**
	 * @var Collection<URL>|null The schema.org \[\[usageInfo\]\] property indicates further information about a \[\[CreativeWork\]\]. This property is applicable both to works that are freely available and to those that require payment or other transactions. It can reference additional information, e.g. community expectations on preferred linking and citation conventions, as well as purchasing details. For something that can be commercially licensed, usageInfo can provide detailed, resource-specific information about licensing options. This property can be used alongside the license property which indicates license(s) applicable to some piece of content. The usageInfo property can provide information about other licensing options, e.g. acquiring commercial usage rights for an image that is also available under non-commercial creative commons licenses.
	 * @see https://schema.org/usageInfo
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\URL')]
	#[ORM\JoinTable(name: 'creative_work_url_usage_info')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/usageInfo'])]
	private ?Collection $usageInfo = null;

	/**
	 * Indicates a correction to a \[\[CreativeWork\]\], either via a \[\[CorrectionComment\]\], textually or in another document.
	 *
	 * @see https://schema.org/correction
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/correction'])]
	#[Assert\Url]
	private ?string $correction = null;

	/**
	 * The overall rating, based on a collection of reviews or ratings, of the item.
	 *
	 * @see https://schema.org/aggregateRating
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\AggregateRating')]
	#[ApiProperty(types: ['https://schema.org/aggregateRating'])]
	private ?AggregateRating $aggregateRating = null;

	/**
	 * The party holding the legal copyright to the CreativeWork.
	 *
	 * @see https://schema.org/copyrightHolder
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ApiProperty(types: ['https://schema.org/copyrightHolder'])]
	private ?Organization $copyrightHolder = null;

	/**
	 * The publishing division which published the comic.
	 *
	 * @see https://schema.org/publisherImprint
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ApiProperty(types: ['https://schema.org/publisherImprint'])]
	private ?Organization $publisherImprint = null;

	/**
	 * The predominant type or kind characterizing the learning resource. For example, 'presentation', 'handout'.
	 *
	 * @see https://schema.org/learningResourceType
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\DefinedTerm')]
	#[ApiProperty(types: ['https://schema.org/learningResourceType'])]
	private ?DefinedTerm $learningResourceType = null;

	/**
	 * The specific time described by a creative work, for works (e.g. articles, video objects etc.) that emphasise a particular moment within an Event.
	 *
	 * @see https://schema.org/contentReferenceTime
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\DateTime')]
	#[ApiProperty(types: ['https://schema.org/contentReferenceTime'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $contentReferenceTime = null;

	/**
	 * The Organization on whose behalf the creator was working.
	 *
	 * @see https://schema.org/sourceOrganization
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ApiProperty(types: ['https://schema.org/sourceOrganization'])]
	private ?Organization $sourceOrganization = null;

	/**
	 * Genre of the creative work, broadcast channel or group.
	 *
	 * @see https://schema.org/genre
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/genre'])]
	#[Assert\Url]
	private ?string $genre = null;

	/**
	 * A citation or reference to another creative work, such as another publication, web page, scholarly article, etc.
	 *
	 * @see https://schema.org/citation
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/citation'])]
	private ?string $citation = null;

	/**
	 * The person or organization who produced the work (e.g. music album, movie, TV/radio series etc.).
	 *
	 * @see https://schema.org/producer
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ApiProperty(types: ['https://schema.org/producer'])]
	private ?Person $producer = null;

	/**
	 * Headline of the article.
	 *
	 * @see https://schema.org/headline
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/headline'])]
	private ?string $headline = null;

	/**
	 * The date on which the CreativeWork was created or the item was added to a DataFeed.
	 *
	 * @see https://schema.org/dateCreated
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
	#[ApiProperty(types: ['https://schema.org/dateCreated'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $dateCreated = null;

	/**
	 * The country of origin of something, including products as well as creative works such as movie and TV content. In the case of TV and movie, this would be the country of the principle offices of the production company or individual responsible for the movie. For other kinds of \[\[CreativeWork\]\] it is difficult to provide fully general guidance, and properties such as \[\[contentLocation\]\] and \[\[locationCreated\]\] may be more applicable. In the case of products, the country of origin of the product. The exact interpretation of this may vary by context and product type, and cannot be fully enumerated here.
	 *
	 * @see https://schema.org/countryOfOrigin
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Country')]
	#[ApiProperty(types: ['https://schema.org/countryOfOrigin'])]
	private ?Country $countryOfOrigin = null;

	/**
	 * A secondary contributor to the CreativeWork or Event.
	 *
	 * @see https://schema.org/contributor
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/contributor'])]
	#[Assert\NotNull]
	private Organization $contributor;

	/**
	 * Media type typically expressed using a MIME format (see \[IANA site\](http://www.iana.org/assignments/media-types/media-types.xhtml) and \[MDN reference\](https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics\_of\_HTTP/MIME\_types)), e.g. application/zip for a SoftwareApplication binary, audio/mpeg for .mp3 etc. In cases where a \[\[CreativeWork\]\] has several media type representations, \[\[encoding\]\] can be used to indicate each \[\[MediaObject\]\] alongside particular \[\[encodingFormat\]\] information. Unregistered or niche encoding and file formats can be indicated instead via the most appropriate URL, e.g. defining Web page or a Wikipedia/Wikidata entry.
	 *
	 * @see https://schema.org/encodingFormat
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/encodingFormat'])]
	private ?string $encodingFormat = null;

	/**
	 * The "temporal" property can be used in cases where more specific properties (e.g. \[\[temporalCoverage\]\], \[\[dateCreated\]\], \[\[dateModified\]\], \[\[datePublished\]\]) are not known to be appropriate.
	 *
	 * @see https://schema.org/temporal
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\DateTime')]
	#[ApiProperty(types: ['https://schema.org/temporal'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $temporal = null;

	/**
	 * The item being described is intended to help a person learn the competency or learning outcome defined by the referenced term.
	 *
	 * @see https://schema.org/teaches
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/teaches'])]
	private ?string $teaches = null;

	/**
	 * An embedded video object.
	 *
	 * @see https://schema.org/video
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\VideoObject')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/video'])]
	#[Assert\NotNull]
	private VideoObject $video;

	/**
	 * An award won by or for this item.
	 *
	 * @see https://schema.org/award
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/award'])]
	private ?string $award = null;

	/**
	 * A human-readable summary of specific accessibility features or deficiencies, consistent with the other accessibility metadata but expressing subtleties such as "short descriptions are present but long descriptions will be needed for non-visual users" or "short descriptions are present and no long descriptions are needed".
	 *
	 * @see https://schema.org/accessibilitySummary
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/accessibilitySummary'])]
	private ?string $accessibilitySummary = null;

	/**
	 * Keywords or tags used to describe some item. Multiple textual entries in a keywords list are typically delimited by commas, or by repeating the property.
	 *
	 * @see https://schema.org/keywords
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/keywords'])]
	private ?string $keywords = null;

	/**
	 * The item being described is intended to assess the competency or learning outcome defined by the referenced term.
	 *
	 * @see https://schema.org/assesses
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/assesses'])]
	private ?string $assesses = null;

	/**
	 * The typical expected age range, e.g. '7-9', '11-'.
	 *
	 * @see https://schema.org/typicalAgeRange
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/typicalAgeRange'])]
	private ?string $typicalAgeRange = null;

	/**
	 * The temporalCoverage of a CreativeWork indicates the period that the content applies to, i.e. that it describes, either as a DateTime or as a textual string indicating a time period in \[ISO 8601 time interval format\](https://en.wikipedia.org/wiki/ISO\_8601#Time\_intervals). In the case of a Dataset it will typically indicate the relevant time period in a precise notation (e.g. for a 2011 census dataset, the year 2011 would be written "2011/2012"). Other forms of content, e.g. ScholarlyArticle, Book, TVSeries or TVEpisode, may indicate their temporalCoverage in broader terms - textually or via well-known URL. Written works such as books may sometimes have precise temporal coverage too, e.g. a work set in 1939 - 1945 can be indicated in ISO 8601 interval format format via "1939/1945". Open-ended date ranges can be written with ".." in place of the end date. For example, "2015-11/.." indicates a range beginning in November 2015 and with no specified final date. This is tentative and might be updated in future when ISO 8601 is officially updated.
	 *
	 * @see https://schema.org/temporalCoverage
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\DateTime')]
	#[ApiProperty(types: ['https://schema.org/temporalCoverage'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $temporalCoverage = null;

	/**
	 * A pattern that something has, for example 'polka dot', 'striped', 'Canadian flag'. Values are typically expressed as text, although links to controlled value schemes are also supported.
	 *
	 * @see https://schema.org/pattern
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\DefinedTerm')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/pattern'])]
	#[Assert\NotNull]
	private DefinedTerm $pattern;

	/**
	 * Used to indicate a specific claim contained, implied, translated or refined from the content of a \[\[MediaObject\]\] or other \[\[CreativeWork\]\]. The interpreting party can be indicated using \[\[claimInterpreter\]\].
	 *
	 * @see https://schema.org/interpretedAsClaim
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Claim')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/interpretedAsClaim'])]
	#[Assert\NotNull]
	private Claim $interpretedAsClaim;

	/**
	 * A media object that encodes this CreativeWork. This property is a synonym for encoding.
	 *
	 * @see https://schema.org/associatedMedia
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MediaObject')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/associatedMedia'])]
	#[Assert\NotNull]
	private MediaObject $associatedMedia;

	/**
	 * Content features of the resource, such as accessible media, alternatives and supported enhancements for accessibility. Values should be drawn from the \[approved vocabulary\](https://www.w3.org/2021/a11y-discov-vocab/latest/#accessibilityFeature-vocabulary).
	 *
	 * @see https://schema.org/accessibilityFeature
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/accessibilityFeature'])]
	private ?string $accessibilityFeature = null;

	/**
	 * A material that something is made from, e.g. leather, wool, cotton, paper.
	 *
	 * @see https://schema.org/material
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/material'])]
	private ?string $material = null;

	/**
	 * An \[EIDR\](https://eidr.org/) (Entertainment Identifier Registry) \[\[identifier\]\] representing a specific edit / edition for a work of film or television. For example, the motion picture known as "Ghostbusters" whose \[\[titleEIDR\]\] is "10.5240/7EC7-228A-510A-053E-CBB8-J" has several edits, e.g. "10.5240/1F2A-E1C5-680A-14C6-E76B-I" and "10.5240/8A35-3BEE-6497-5D12-9E4F-3". Since schema.org types like \[\[Movie\]\] and \[\[TVEpisode\]\] can be used for both works and their multiple expressions, it is possible to use \[\[titleEIDR\]\] alone (for a general description), or alongside \[\[editEIDR\]\] for a more edit-specific description.
	 *
	 * @see https://schema.org/editEIDR
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/editEIDR'])]
	private ?string $editEIDR = null;

	/**
	 * Text of a notice appropriate for describing the copyright aspects of this Creative Work, ideally indicating the owner of the copyright for the Work.
	 *
	 * @see https://schema.org/copyrightNotice
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/copyrightNotice'])]
	private ?string $copyrightNotice = null;

	/**
	 * The status of a creative work in terms of its stage in a lifecycle. Example terms include Incomplete, Draft, Published, Obsolete. Some organizations define a set of terms for the stages of their publication lifecycle.
	 *
	 * @see https://schema.org/creativeWorkStatus
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/creativeWorkStatus'])]
	private ?string $creativeWorkStatus = null;

	/**
	 * The year during which the claimed copyright for the CreativeWork was first asserted.
	 *
	 * @see https://schema.org/copyrightYear
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/copyrightYear'])]
	private ?string $copyrightYear = null;

	/**
	 * @var Collection<Text>|null Text that can be used to credit person(s) and/or organization(s) associated with a published Creative Work.
	 * @see https://schema.org/creditText
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinTable(name: 'creative_work_text_credit_text')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/creditText'])]
	private ?Collection $creditText = null;

	/**
	 * @var Collection<Text>|null Conditions that affect the availability of, or method(s) of access to, an item. Typically used for real world items such as an \[\[ArchiveComponent\]\] held by an \[\[ArchiveOrganization\]\]. This property is not suitable for use as a general Web access control mechanism. It is expressed only in natural language.\\n\\nFor example "Available by appointment from the Reading Room" or "Accessible only from logged-in accounts ".
	 * @see https://schema.org/conditionsOfAccess
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinTable(name: 'creative_work_text_conditions_of_access')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/conditionsOfAccess'])]
	private ?Collection $conditionsOfAccess = null;

	/**
	 * Comments, typically from users.
	 *
	 * @see https://schema.org/comment
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Comment')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/comment'])]
	#[Assert\NotNull]
	private Comment $comment;

	/**
	 * @var string[]|null Indicates an IPTCDigitalSourceEnumeration code indicating the nature of the digital source(s) for some \[\[CreativeWork\]\].
	 * @see https://schema.org/digitalSourceType
	 */
	#[ORM\Column(type: 'simple_array', nullable: true)]
	#[ApiProperty(types: ['https://schema.org/digitalSourceType'])]
	#[Assert\Choice(callback: [IPTCDigitalSourceEnumeration::class, 'toArray'], multiple: true)]
	private ?Collection $digitalSourceType = null;

	/**
	 * The author of this content or rating. Please note that author is special in that HTML 5 provides a special mechanism for indicating authorship via the rel tag. That is equivalent to this and may be used interchangeably.
	 *
	 * @see https://schema.org/author
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ApiProperty(types: ['https://schema.org/author'])]
	private ?Person $author = null;

	/**
	 * A secondary title of the CreativeWork.
	 *
	 * @see https://schema.org/alternativeHeadline
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/alternativeHeadline'])]
	private ?string $alternativeHeadline = null;

	/**
	 * Specifies the Person who edited the CreativeWork.
	 *
	 * @see https://schema.org/editor
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/editor'])]
	#[Assert\NotNull]
	private Person $editor;

	/**
	 * Thumbnail image for an image or video.
	 *
	 * @see https://schema.org/thumbnail
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\ImageObject')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/thumbnail'])]
	#[Assert\NotNull]
	private ImageObject $thumbnail;

	/**
	 * A license document that applies to this structured data, typically indicated by URL.
	 *
	 * @see https://schema.org/sdLicense
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/sdLicense'])]
	#[Assert\Url]
	private ?string $sdLicense = null;

	/**
	 * Indicates whether this content is family friendly.
	 *
	 * @see https://schema.org/isFamilyFriendly
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Boolean')]
	#[ApiProperty(types: ['https://schema.org/isFamilyFriendly'])]
	private ?bool $isFamilyFriendly = null;

	/**
	 * Specifies the Person that is legally accountable for the CreativeWork.
	 *
	 * @see https://schema.org/accountablePerson
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/accountablePerson'])]
	#[Assert\NotNull]
	private Person $accountablePerson;

	/**
	 * The predominant mode of learning supported by the learning resource. Acceptable values are 'active', 'expositive', or 'mixed'.
	 *
	 * @see https://schema.org/interactivityType
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/interactivityType'])]
	private ?string $interactivityType = null;

	/**
	 * A link to the page containing the comments of the CreativeWork.
	 *
	 * @see https://schema.org/discussionUrl
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/discussionUrl'])]
	#[Assert\Url]
	private ?string $discussionUrl = null;

	/**
	 * A review of the item.
	 *
	 * @see https://schema.org/review
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Review')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/review'])]
	#[Assert\NotNull]
	private Review $review;

	/**
	 * A flag to signal that the item, event, or place is accessible for free.
	 *
	 * @see https://schema.org/isAccessibleForFree
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Boolean')]
	#[ApiProperty(types: ['https://schema.org/isAccessibleForFree'])]
	private ?bool $isAccessibleForFree = null;

	/**
	 * The quantity of the materials being described or an expression of the physical space they occupy.
	 *
	 * @see https://schema.org/materialExtent
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/materialExtent'])]
	private ?string $materialExtent = null;

	/**
	 * An intended audience, i.e. a group for whom something was created.
	 *
	 * @see https://schema.org/audience
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Audience')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/audience'])]
	#[Assert\NotNull]
	private Audience $audience;

	/**
	 * A publication event associated with the item.
	 *
	 * @see https://schema.org/publication
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\PublicationEvent')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/publication'])]
	#[Assert\NotNull]
	private PublicationEvent $publication;

	/**
	 * Official rating of a piece of content—for example, 'MPAA PG-13'.
	 *
	 * @see https://schema.org/contentRating
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Rating')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/contentRating'])]
	#[Assert\NotNull]
	private Rating $contentRating;

	/**
	 * The level in terms of progression through an educational or training context. Examples of educational levels include 'beginner', 'intermediate' or 'advanced', and formal sets of level indicators.
	 *
	 * @see https://schema.org/educationalLevel
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/educationalLevel'])]
	private ?string $educationalLevel = null;

	/**
	 * The location where the CreativeWork was created, which may not be the same as the location depicted in the CreativeWork.
	 *
	 * @see https://schema.org/locationCreated
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Place')]
	#[ApiProperty(types: ['https://schema.org/locationCreated'])]
	private ?Place $locationCreated = null;

	/**
	 * A thumbnail image relevant to the Thing.
	 *
	 * @see https://schema.org/thumbnailUrl
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/thumbnailUrl'])]
	#[Assert\Url]
	private ?string $thumbnailUrl = null;

	/**
	 * An abstract is a short description that summarizes a \[\[CreativeWork\]\].
	 *
	 * @see https://schema.org/abstract
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/abstract'])]
	private ?string $abstract = null;

	/**
	 * Indicates the date on which the current structured data was generated / published. Typically used alongside \[\[sdPublisher\]\].
	 *
	 * @see https://schema.org/sdDatePublished
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Date')]
	#[ApiProperty(types: ['https://schema.org/sdDatePublished'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $sdDatePublished = null;

	/**
	 * A list of single or combined accessModes that are sufficient to understand all the intellectual content of a resource. Values should be drawn from the \[approved vocabulary\](https://www.w3.org/2021/a11y-discov-vocab/latest/#accessModeSufficient-vocabulary).
	 *
	 * @see https://schema.org/accessModeSufficient
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\ItemList')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/accessModeSufficient'])]
	#[Assert\NotNull]
	private ItemList $accessModeSufficient;

	/**
	 * Indicates that the CreativeWork contains a reference to, but is not necessarily about a concept.
	 *
	 * @see https://schema.org/mentions
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Thing')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/mentions'])]
	#[Assert\NotNull]
	private Thing $mentions;

	/**
	 * An embedded audio object.
	 *
	 * @see https://schema.org/audio
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\AudioObject')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/audio'])]
	#[Assert\NotNull]
	private AudioObject $audio;

	/**
	 * The number of interactions for the CreativeWork using the WebSite or SoftwareApplication. The most specific child type of InteractionCounter should be used.
	 *
	 * @see https://schema.org/interactionStatistic
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\InteractionCounter')]
	#[ApiProperty(types: ['https://schema.org/interactionStatistic'])]
	private ?InteractionCounter $interactionStatistic = null;

	/**
	 * An alignment to an established educational framework. This property should not be used where the nature of the alignment can be described using a simple property, for example to express that a resource \[\[teaches\]\] or \[\[assesses\]\] a competency.
	 *
	 * @see https://schema.org/educationalAlignment
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\AlignmentObject')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/educationalAlignment'])]
	#[Assert\NotNull]
	private AlignmentObject $educationalAlignment;

	/**
	 * The textual content of this CreativeWork.
	 *
	 * @see https://schema.org/text
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/text'])]
	private ?string $text = null;

	/**
	 * The number of comments this CreativeWork (e.g. Article, Question or Answer) has received. This is most applicable to works published in Web sites with commenting system; additional comments may exist elsewhere.
	 *
	 * @see https://schema.org/commentCount
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
	#[ApiProperty(types: ['https://schema.org/commentCount'])]
	private ?int $commentCount = null;

	/**
	 * Indicates the party responsible for generating and publishing the current structured data markup, typically in cases where the structured data is derived automatically from existing published content but published on a different site. For example, student projects and open data initiatives often re-publish existing content with more explicitly structured metadata. The \[\[sdPublisher\]\] property helps make such practices more explicit.
	 *
	 * @see https://schema.org/sdPublisher
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/sdPublisher'])]
	#[Assert\NotNull]
	private Organization $sdPublisher;

	/**
	 * Date of first publication or broadcast. For example the date a \[\[CreativeWork\]\] was broadcast or a \[\[Certification\]\] was issued.
	 *
	 * @see https://schema.org/datePublished
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Date')]
	#[ApiProperty(types: ['https://schema.org/datePublished'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $datePublished = null;

	/**
	 * Indicates the primary entity described in some page or other CreativeWork.
	 *
	 * @see https://schema.org/mainEntity
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Thing')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/mainEntity'])]
	#[Assert\NotNull]
	private Thing $mainEntity;

	/**
	 * The subject matter of the content.
	 *
	 * @see https://schema.org/about
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Thing')]
	#[ApiProperty(types: ['https://schema.org/about'])]
	private ?Thing $about = null;

	/**
	 * @var Collection<Demand>|null An offer to provide this item—for example, an offer to sell a product, rent the DVD of a movie, perform a service, or give away tickets to an event. Use \[\[businessFunction\]\] to indicate the kind of transaction offered, i.e. sell, lease, etc. This property can also be used to describe a \[\[Demand\]\]. While this property is listed as expected on a number of common types, it can be used in others. In that case, using a second type, such as Product or a subtype of Product, can clarify the nature of the offer.
	 * @see https://schema.org/offers
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Demand')]
	#[ORM\JoinTable(name: 'creative_work_demand_offers')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/offers'])]
	private ?Collection $offers = null;

	/**
	 * The Event where the CreativeWork was recorded. The CreativeWork may capture all or part of the event.
	 *
	 * @see https://schema.org/recordedAt
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Event')]
	#[ApiProperty(types: ['https://schema.org/recordedAt'])]
	private ?Event $recordedAt = null;

	/**
	 * A \[\[Grant\]\] that directly or indirectly provide funding or sponsorship for this item. See also \[\[ownershipFundingInfo\]\].
	 *
	 * @see https://schema.org/funding
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Grant')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/funding'])]
	#[Assert\NotNull]
	private Grant $funding;

	/**
	 * The work that this work has been translated from. E.g. 物种起源 is a translationOf “On the Origin of Species”.
	 *
	 * @see https://schema.org/translationOfWork
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWork')]
	#[ApiProperty(types: ['https://schema.org/translationOfWork'])]
	private ?CreativeWork $translationOfWork = null;

	/**
	 * A work that is a translation of the content of this work. E.g. 西遊記 has an English workTranslation “Journey to the West”, a German workTranslation “Monkeys Pilgerfahrt” and a Vietnamese translation Tây du ký bình khảo.
	 *
	 * @see https://schema.org/workTranslation
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWork')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/workTranslation'])]
	#[Assert\NotNull]
	private CreativeWork $workTranslation;

	/**
	 * A creative work that this work is an example/instance/realization/derivation of.
	 *
	 * @see https://schema.org/exampleOfWork
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWork')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/exampleOfWork'])]
	#[Assert\NotNull]
	private CreativeWork $exampleOfWork;

	/**
	 * The location depicted or described in the content. For example, the location in a photograph or painting.
	 *
	 * @see https://schema.org/contentLocation
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Place')]
	#[ApiProperty(types: ['https://schema.org/contentLocation'])]
	private ?Place $contentLocation = null;

	function __construct()
	{
		$this->spatialCoverage = new ArrayCollection();
		$this->usageInfo = new ArrayCollection();
		$this->creditText = new ArrayCollection();
		$this->conditionsOfAccess = new ArrayCollection();
		$this->offers = new ArrayCollection();
	}

	public function setHasPart(CreativeWork $hasPart): void
	{
		$this->hasPart = $hasPart;
	}

	public function getHasPart(): CreativeWork
	{
		return $this->hasPart;
	}

	public function setEducationalUse(?string $educationalUse): void
	{
		$this->educationalUse = $educationalUse;
	}

	public function getEducationalUse(): ?string
	{
		return $this->educationalUse;
	}

	public function setEncoding(MediaObject $encoding): void
	{
		$this->encoding = $encoding;
	}

	public function getEncoding(): MediaObject
	{
		return $this->encoding;
	}

	public function setAccessMode(?string $accessMode): void
	{
		$this->accessMode = $accessMode;
	}

	public function getAccessMode(): ?string
	{
		return $this->accessMode;
	}

	public function setPublishingPrinciples(?string $publishingPrinciples): void
	{
		$this->publishingPrinciples = $publishingPrinciples;
	}

	public function getPublishingPrinciples(): ?string
	{
		return $this->publishingPrinciples;
	}

	public function setInLanguage(?string $inLanguage): void
	{
		$this->inLanguage = $inLanguage;
	}

	public function getInLanguage(): ?string
	{
		return $this->inLanguage;
	}

	public function setWorkExample(CreativeWork $workExample): void
	{
		$this->workExample = $workExample;
	}

	public function getWorkExample(): CreativeWork
	{
		return $this->workExample;
	}

	public function setProvider(?Person $provider): void
	{
		$this->provider = $provider;
	}

	public function getProvider(): ?Person
	{
		return $this->provider;
	}

	public function setTranslator(Person $translator): void
	{
		$this->translator = $translator;
	}

	public function getTranslator(): Person
	{
		return $this->translator;
	}

	public function setFunder(Organization $funder): void
	{
		$this->funder = $funder;
	}

	public function getFunder(): Organization
	{
		return $this->funder;
	}

	public function setSponsor(Organization $sponsor): void
	{
		$this->sponsor = $sponsor;
	}

	public function getSponsor(): Organization
	{
		return $this->sponsor;
	}

	public function setAccessibilityHazard(?string $accessibilityHazard): void
	{
		$this->accessibilityHazard = $accessibilityHazard;
	}

	public function getAccessibilityHazard(): ?string
	{
		return $this->accessibilityHazard;
	}

	public function setAccessibilityAPI(?string $accessibilityAPI): void
	{
		$this->accessibilityAPI = $accessibilityAPI;
	}

	public function getAccessibilityAPI(): ?string
	{
		return $this->accessibilityAPI;
	}

	public function setSize(?string $size): void
	{
		$this->size = $size;
	}

	public function getSize(): ?string
	{
		return $this->size;
	}

	public function setPublisher(?Organization $publisher): void
	{
		$this->publisher = $publisher;
	}

	public function getPublisher(): ?Organization
	{
		return $this->publisher;
	}

	public function setDateModified(?\DateTimeInterface $dateModified): void
	{
		$this->dateModified = $dateModified;
	}

	public function getDateModified(): ?\DateTimeInterface
	{
		return $this->dateModified;
	}

	public function setSchemaVersion(?string $schemaVersion): void
	{
		$this->schemaVersion = $schemaVersion;
	}

	public function getSchemaVersion(): ?string
	{
		return $this->schemaVersion;
	}

	public function setLicense(?string $license): void
	{
		$this->license = $license;
	}

	public function getLicense(): ?string
	{
		return $this->license;
	}

	public function setIsBasedOn(?Product $isBasedOn): void
	{
		$this->isBasedOn = $isBasedOn;
	}

	public function getIsBasedOn(): ?Product
	{
		return $this->isBasedOn;
	}

	public function setPosition(?int $position): void
	{
		$this->position = $position;
	}

	public function getPosition(): ?int
	{
		return $this->position;
	}

	public function setReleasedEvent(?PublicationEvent $releasedEvent): void
	{
		$this->releasedEvent = $releasedEvent;
	}

	public function getReleasedEvent(): ?PublicationEvent
	{
		return $this->releasedEvent;
	}

	public function addSpatialCoverage(Place $spatialCoverage): void
	{
		$this->spatialCoverage[] = $spatialCoverage;
	}

	public function removeSpatialCoverage(Place $spatialCoverage): void
	{
		$this->spatialCoverage->removeElement($spatialCoverage);
	}

	/**
	 * @return Collection<Place>|null
	 */
	public function getSpatialCoverage(): Collection
	{
		return $this->spatialCoverage;
	}

	public function setCreator(?Organization $creator): void
	{
		$this->creator = $creator;
	}

	public function getCreator(): ?Organization
	{
		return $this->creator;
	}

	public function setTimeRequired(Duration $timeRequired): void
	{
		$this->timeRequired = $timeRequired;
	}

	public function getTimeRequired(): Duration
	{
		return $this->timeRequired;
	}

	public function setIsPartOf(?string $isPartOf): void
	{
		$this->isPartOf = $isPartOf;
	}

	public function getIsPartOf(): ?string
	{
		return $this->isPartOf;
	}

	public function setCharacter(Person $character): void
	{
		$this->character = $character;
	}

	public function getCharacter(): Person
	{
		return $this->character;
	}

	public function setVersion(?string $version): void
	{
		$this->version = $version;
	}

	public function getVersion(): ?string
	{
		return $this->version;
	}

	public function setExpires(?\DateTimeInterface $expires): void
	{
		$this->expires = $expires;
	}

	public function getExpires(): ?\DateTimeInterface
	{
		return $this->expires;
	}

	public function setArchivedAt(?string $archivedAt): void
	{
		$this->archivedAt = $archivedAt;
	}

	public function getArchivedAt(): ?string
	{
		return $this->archivedAt;
	}

	public function setAccessibilityControl(?string $accessibilityControl): void
	{
		$this->accessibilityControl = $accessibilityControl;
	}

	public function getAccessibilityControl(): ?string
	{
		return $this->accessibilityControl;
	}

	public function setMaintainer(Organization $maintainer): void
	{
		$this->maintainer = $maintainer;
	}

	public function getMaintainer(): Organization
	{
		return $this->maintainer;
	}

	public function setSpatial(?Place $spatial): void
	{
		$this->spatial = $spatial;
	}

	public function getSpatial(): ?Place
	{
		return $this->spatial;
	}

	public function setAcquireLicensePage(CreativeWork $acquireLicensePage): void
	{
		$this->acquireLicensePage = $acquireLicensePage;
	}

	public function getAcquireLicensePage(): CreativeWork
	{
		return $this->acquireLicensePage;
	}

	public function addUsageInfo(string $usageInfo): void
	{
		$this->usageInfo[] = $usageInfo;
	}

	public function removeUsageInfo(string $usageInfo): void
	{
		$this->usageInfo->removeElement($usageInfo);
	}

	/**
	 * @return Collection<URL>|null
	 */
	public function getUsageInfo(): Collection
	{
		return $this->usageInfo;
	}

	public function setCorrection(?string $correction): void
	{
		$this->correction = $correction;
	}

	public function getCorrection(): ?string
	{
		return $this->correction;
	}

	public function setAggregateRating(?AggregateRating $aggregateRating): void
	{
		$this->aggregateRating = $aggregateRating;
	}

	public function getAggregateRating(): ?AggregateRating
	{
		return $this->aggregateRating;
	}

	public function setCopyrightHolder(?Organization $copyrightHolder): void
	{
		$this->copyrightHolder = $copyrightHolder;
	}

	public function getCopyrightHolder(): ?Organization
	{
		return $this->copyrightHolder;
	}

	public function setPublisherImprint(?Organization $publisherImprint): void
	{
		$this->publisherImprint = $publisherImprint;
	}

	public function getPublisherImprint(): ?Organization
	{
		return $this->publisherImprint;
	}

	public function setLearningResourceType(?DefinedTerm $learningResourceType): void
	{
		$this->learningResourceType = $learningResourceType;
	}

	public function getLearningResourceType(): ?DefinedTerm
	{
		return $this->learningResourceType;
	}

	public function setContentReferenceTime(?\DateTimeInterface $contentReferenceTime): void
	{
		$this->contentReferenceTime = $contentReferenceTime;
	}

	public function getContentReferenceTime(): ?\DateTimeInterface
	{
		return $this->contentReferenceTime;
	}

	public function setSourceOrganization(?Organization $sourceOrganization): void
	{
		$this->sourceOrganization = $sourceOrganization;
	}

	public function getSourceOrganization(): ?Organization
	{
		return $this->sourceOrganization;
	}

	public function setGenre(?string $genre): void
	{
		$this->genre = $genre;
	}

	public function getGenre(): ?string
	{
		return $this->genre;
	}

	public function setCitation(?string $citation): void
	{
		$this->citation = $citation;
	}

	public function getCitation(): ?string
	{
		return $this->citation;
	}

	public function setProducer(?Person $producer): void
	{
		$this->producer = $producer;
	}

	public function getProducer(): ?Person
	{
		return $this->producer;
	}

	public function setHeadline(?string $headline): void
	{
		$this->headline = $headline;
	}

	public function getHeadline(): ?string
	{
		return $this->headline;
	}

	public function setDateCreated(?\DateTimeInterface $dateCreated): void
	{
		$this->dateCreated = $dateCreated;
	}

	public function getDateCreated(): ?\DateTimeInterface
	{
		return $this->dateCreated;
	}

	public function setCountryOfOrigin(?Country $countryOfOrigin): void
	{
		$this->countryOfOrigin = $countryOfOrigin;
	}

	public function getCountryOfOrigin(): ?Country
	{
		return $this->countryOfOrigin;
	}

	public function setContributor(Organization $contributor): void
	{
		$this->contributor = $contributor;
	}

	public function getContributor(): Organization
	{
		return $this->contributor;
	}

	public function setEncodingFormat(?string $encodingFormat): void
	{
		$this->encodingFormat = $encodingFormat;
	}

	public function getEncodingFormat(): ?string
	{
		return $this->encodingFormat;
	}

	public function setTemporal(?\DateTimeInterface $temporal): void
	{
		$this->temporal = $temporal;
	}

	public function getTemporal(): ?\DateTimeInterface
	{
		return $this->temporal;
	}

	public function setTeaches(?string $teaches): void
	{
		$this->teaches = $teaches;
	}

	public function getTeaches(): ?string
	{
		return $this->teaches;
	}

	public function setVideo(VideoObject $video): void
	{
		$this->video = $video;
	}

	public function getVideo(): VideoObject
	{
		return $this->video;
	}

	public function setAward(?string $award): void
	{
		$this->award = $award;
	}

	public function getAward(): ?string
	{
		return $this->award;
	}

	public function setAccessibilitySummary(?string $accessibilitySummary): void
	{
		$this->accessibilitySummary = $accessibilitySummary;
	}

	public function getAccessibilitySummary(): ?string
	{
		return $this->accessibilitySummary;
	}

	public function setKeywords(?string $keywords): void
	{
		$this->keywords = $keywords;
	}

	public function getKeywords(): ?string
	{
		return $this->keywords;
	}

	public function setAssesses(?string $assesses): void
	{
		$this->assesses = $assesses;
	}

	public function getAssesses(): ?string
	{
		return $this->assesses;
	}

	public function setTypicalAgeRange(?string $typicalAgeRange): void
	{
		$this->typicalAgeRange = $typicalAgeRange;
	}

	public function getTypicalAgeRange(): ?string
	{
		return $this->typicalAgeRange;
	}

	public function setTemporalCoverage(?\DateTimeInterface $temporalCoverage): void
	{
		$this->temporalCoverage = $temporalCoverage;
	}

	public function getTemporalCoverage(): ?\DateTimeInterface
	{
		return $this->temporalCoverage;
	}

	public function setPattern(DefinedTerm $pattern): void
	{
		$this->pattern = $pattern;
	}

	public function getPattern(): DefinedTerm
	{
		return $this->pattern;
	}

	public function setInterpretedAsClaim(Claim $interpretedAsClaim): void
	{
		$this->interpretedAsClaim = $interpretedAsClaim;
	}

	public function getInterpretedAsClaim(): Claim
	{
		return $this->interpretedAsClaim;
	}

	public function setAssociatedMedia(MediaObject $associatedMedia): void
	{
		$this->associatedMedia = $associatedMedia;
	}

	public function getAssociatedMedia(): MediaObject
	{
		return $this->associatedMedia;
	}

	public function setAccessibilityFeature(?string $accessibilityFeature): void
	{
		$this->accessibilityFeature = $accessibilityFeature;
	}

	public function getAccessibilityFeature(): ?string
	{
		return $this->accessibilityFeature;
	}

	public function setMaterial(?string $material): void
	{
		$this->material = $material;
	}

	public function getMaterial(): ?string
	{
		return $this->material;
	}

	public function setEditEIDR(?string $editEIDR): void
	{
		$this->editEIDR = $editEIDR;
	}

	public function getEditEIDR(): ?string
	{
		return $this->editEIDR;
	}

	public function setCopyrightNotice(?string $copyrightNotice): void
	{
		$this->copyrightNotice = $copyrightNotice;
	}

	public function getCopyrightNotice(): ?string
	{
		return $this->copyrightNotice;
	}

	public function setCreativeWorkStatus(?string $creativeWorkStatus): void
	{
		$this->creativeWorkStatus = $creativeWorkStatus;
	}

	public function getCreativeWorkStatus(): ?string
	{
		return $this->creativeWorkStatus;
	}

	public function setCopyrightYear(?string $copyrightYear): void
	{
		$this->copyrightYear = $copyrightYear;
	}

	public function getCopyrightYear(): ?string
	{
		return $this->copyrightYear;
	}

	public function addCreditText(string $creditText): void
	{
		$this->creditText[] = $creditText;
	}

	public function removeCreditText(string $creditText): void
	{
		$this->creditText->removeElement($creditText);
	}

	/**
	 * @return Collection<Text>|null
	 */
	public function getCreditText(): Collection
	{
		return $this->creditText;
	}

	public function addConditionsOfAcces(string $conditionsOfAcces): void
	{
		$this->conditionsOfAccess[] = $conditionsOfAcces;
	}

	public function removeConditionsOfAcces(string $conditionsOfAcces): void
	{
		$this->conditionsOfAccess->removeElement($conditionsOfAcces);
	}

	/**
	 * @return Collection<Text>|null
	 */
	public function getConditionsOfAccess(): Collection
	{
		return $this->conditionsOfAccess;
	}

	public function setComment(Comment $comment): void
	{
		$this->comment = $comment;
	}

	public function getComment(): Comment
	{
		return $this->comment;
	}

	public function addDigitalSourceType($digitalSourceType): void
	{
		$this->digitalSourceType[] = (string) $digitalSourceType;
	}

	public function removeDigitalSourceType(string $digitalSourceType): void
	{
		if (false !== $key = array_search((string)$digitalSourceType, $this->digitalSourceType ?? [], true)) {
		    unset($this->digitalSourceType[$key]);
		}
	}

	/**
	 * @return string[]|null
	 */
	public function getDigitalSourceType(): Collection
	{
		return $this->digitalSourceType;
	}

	public function setAuthor(?Person $author): void
	{
		$this->author = $author;
	}

	public function getAuthor(): ?Person
	{
		return $this->author;
	}

	public function setAlternativeHeadline(?string $alternativeHeadline): void
	{
		$this->alternativeHeadline = $alternativeHeadline;
	}

	public function getAlternativeHeadline(): ?string
	{
		return $this->alternativeHeadline;
	}

	public function setEditor(Person $editor): void
	{
		$this->editor = $editor;
	}

	public function getEditor(): Person
	{
		return $this->editor;
	}

	public function setThumbnail(ImageObject $thumbnail): void
	{
		$this->thumbnail = $thumbnail;
	}

	public function getThumbnail(): ImageObject
	{
		return $this->thumbnail;
	}

	public function setSdLicense(?string $sdLicense): void
	{
		$this->sdLicense = $sdLicense;
	}

	public function getSdLicense(): ?string
	{
		return $this->sdLicense;
	}

	public function setIsFamilyFriendly(?bool $isFamilyFriendly): void
	{
		$this->isFamilyFriendly = $isFamilyFriendly;
	}

	public function getIsFamilyFriendly(): ?bool
	{
		return $this->isFamilyFriendly;
	}

	public function setAccountablePerson(Person $accountablePerson): void
	{
		$this->accountablePerson = $accountablePerson;
	}

	public function getAccountablePerson(): Person
	{
		return $this->accountablePerson;
	}

	public function setInteractivityType(?string $interactivityType): void
	{
		$this->interactivityType = $interactivityType;
	}

	public function getInteractivityType(): ?string
	{
		return $this->interactivityType;
	}

	public function setDiscussionUrl(?string $discussionUrl): void
	{
		$this->discussionUrl = $discussionUrl;
	}

	public function getDiscussionUrl(): ?string
	{
		return $this->discussionUrl;
	}

	public function setReview(Review $review): void
	{
		$this->review = $review;
	}

	public function getReview(): Review
	{
		return $this->review;
	}

	public function setIsAccessibleForFree(?bool $isAccessibleForFree): void
	{
		$this->isAccessibleForFree = $isAccessibleForFree;
	}

	public function getIsAccessibleForFree(): ?bool
	{
		return $this->isAccessibleForFree;
	}

	public function setMaterialExtent(?string $materialExtent): void
	{
		$this->materialExtent = $materialExtent;
	}

	public function getMaterialExtent(): ?string
	{
		return $this->materialExtent;
	}

	public function setAudience(Audience $audience): void
	{
		$this->audience = $audience;
	}

	public function getAudience(): Audience
	{
		return $this->audience;
	}

	public function setPublication(PublicationEvent $publication): void
	{
		$this->publication = $publication;
	}

	public function getPublication(): PublicationEvent
	{
		return $this->publication;
	}

	public function setContentRating(Rating $contentRating): void
	{
		$this->contentRating = $contentRating;
	}

	public function getContentRating(): Rating
	{
		return $this->contentRating;
	}

	public function setEducationalLevel(?string $educationalLevel): void
	{
		$this->educationalLevel = $educationalLevel;
	}

	public function getEducationalLevel(): ?string
	{
		return $this->educationalLevel;
	}

	public function setLocationCreated(?Place $locationCreated): void
	{
		$this->locationCreated = $locationCreated;
	}

	public function getLocationCreated(): ?Place
	{
		return $this->locationCreated;
	}

	public function setThumbnailUrl(?string $thumbnailUrl): void
	{
		$this->thumbnailUrl = $thumbnailUrl;
	}

	public function getThumbnailUrl(): ?string
	{
		return $this->thumbnailUrl;
	}

	public function setAbstract(?string $abstract): void
	{
		$this->abstract = $abstract;
	}

	public function getAbstract(): ?string
	{
		return $this->abstract;
	}

	public function setSdDatePublished(?\DateTimeInterface $sdDatePublished): void
	{
		$this->sdDatePublished = $sdDatePublished;
	}

	public function getSdDatePublished(): ?\DateTimeInterface
	{
		return $this->sdDatePublished;
	}

	public function setAccessModeSufficient(ItemList $accessModeSufficient): void
	{
		$this->accessModeSufficient = $accessModeSufficient;
	}

	public function getAccessModeSufficient(): ItemList
	{
		return $this->accessModeSufficient;
	}

	public function setMentions(Thing $mentions): void
	{
		$this->mentions = $mentions;
	}

	public function getMentions(): Thing
	{
		return $this->mentions;
	}

	public function setAudio(AudioObject $audio): void
	{
		$this->audio = $audio;
	}

	public function getAudio(): AudioObject
	{
		return $this->audio;
	}

	public function setInteractionStatistic(?InteractionCounter $interactionStatistic): void
	{
		$this->interactionStatistic = $interactionStatistic;
	}

	public function getInteractionStatistic(): ?InteractionCounter
	{
		return $this->interactionStatistic;
	}

	public function setEducationalAlignment(AlignmentObject $educationalAlignment): void
	{
		$this->educationalAlignment = $educationalAlignment;
	}

	public function getEducationalAlignment(): AlignmentObject
	{
		return $this->educationalAlignment;
	}

	public function setText(?string $text): void
	{
		$this->text = $text;
	}

	public function getText(): ?string
	{
		return $this->text;
	}

	public function setCommentCount(?int $commentCount): void
	{
		$this->commentCount = $commentCount;
	}

	public function getCommentCount(): ?int
	{
		return $this->commentCount;
	}

	public function setSdPublisher(Organization $sdPublisher): void
	{
		$this->sdPublisher = $sdPublisher;
	}

	public function getSdPublisher(): Organization
	{
		return $this->sdPublisher;
	}

	public function setDatePublished(?\DateTimeInterface $datePublished): void
	{
		$this->datePublished = $datePublished;
	}

	public function getDatePublished(): ?\DateTimeInterface
	{
		return $this->datePublished;
	}

	public function setMainEntity(Thing $mainEntity): void
	{
		$this->mainEntity = $mainEntity;
	}

	public function getMainEntity(): Thing
	{
		return $this->mainEntity;
	}

	public function setAbout(?Thing $about): void
	{
		$this->about = $about;
	}

	public function getAbout(): ?Thing
	{
		return $this->about;
	}

	public function addOffer(Demand $offer): void
	{
		$this->offers[] = $offer;
	}

	public function removeOffer(Demand $offer): void
	{
		$this->offers->removeElement($offer);
	}

	/**
	 * @return Collection<Demand>|null
	 */
	public function getOffers(): Collection
	{
		return $this->offers;
	}

	public function setRecordedAt(?Event $recordedAt): void
	{
		$this->recordedAt = $recordedAt;
	}

	public function getRecordedAt(): ?Event
	{
		return $this->recordedAt;
	}

	public function setFunding(Grant $funding): void
	{
		$this->funding = $funding;
	}

	public function getFunding(): Grant
	{
		return $this->funding;
	}

	public function setTranslationOfWork(?CreativeWork $translationOfWork): void
	{
		$this->translationOfWork = $translationOfWork;
	}

	public function getTranslationOfWork(): ?CreativeWork
	{
		return $this->translationOfWork;
	}

	public function setWorkTranslation(CreativeWork $workTranslation): void
	{
		$this->workTranslation = $workTranslation;
	}

	public function getWorkTranslation(): CreativeWork
	{
		return $this->workTranslation;
	}

	public function setExampleOfWork(CreativeWork $exampleOfWork): void
	{
		$this->exampleOfWork = $exampleOfWork;
	}

	public function getExampleOfWork(): CreativeWork
	{
		return $this->exampleOfWork;
	}

	public function setContentLocation(?Place $contentLocation): void
	{
		$this->contentLocation = $contentLocation;
	}

	public function getContentLocation(): ?Place
	{
		return $this->contentLocation;
	}
}
