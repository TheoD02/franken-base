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
use App\Enum\NonprofitType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An organization such as a school, NGO, corporation, club, etc.
 *
 * @see https://schema.org/Organization
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
	'organization' => Organization::class,
	'governmentOrganization' => GovernmentOrganization::class,
	'librarySystem' => LibrarySystem::class,
	'fundingScheme' => FundingScheme::class,
	'researchOrganization' => ResearchOrganization::class,
	'consortium' => Consortium::class,
	'searchRescueOrganization' => SearchRescueOrganization::class,
	'NGO' => NGO::class,
	'politicalParty' => PoliticalParty::class,
	'workersUnion' => WorkersUnion::class,
	'airline' => Airline::class,
	'corporation' => Corporation::class,
	'newsMediaOrganization' => NewsMediaOrganization::class,
	'medicalOrganization' => MedicalOrganization::class,
	'sportsTeam' => SportsTeam::class,
	'professionalService' => ProfessionalService::class,
	'employmentAgency' => EmploymentAgency::class,
	'radioStation' => RadioStation::class,
	'animalShelter' => AnimalShelter::class,
	'recyclingCenter' => RecyclingCenter::class,
	'dentist' => Dentist::class,
	'library' => Library::class,
	'internetCafe' => InternetCafe::class,
	'childCare' => ChildCare::class,
	'shoppingCenter' => ShoppingCenter::class,
	'touristInformationCenter' => TouristInformationCenter::class,
	'travelAgency' => TravelAgency::class,
	'selfStorage' => SelfStorage::class,
	'televisionStation' => TelevisionStation::class,
	'dryCleaningOrLaundry' => DryCleaningOrLaundry::class,
	'foodEstablishment' => FoodEstablishment::class,
	'sportsActivityLocation' => SportsActivityLocation::class,
	'entertainmentBusiness' => EntertainmentBusiness::class,
	'realEstateAgent' => RealEstateAgent::class,
	'archiveOrganization' => ArchiveOrganization::class,
	'onlineStore' => OnlineStore::class,
	'middleSchool' => MiddleSchool::class,
	'collegeOrUniversity' => CollegeOrUniversity::class,
	'elementarySchool' => ElementarySchool::class,
	'highSchool' => HighSchool::class,
	'school' => School::class,
	'preschool' => Preschool::class,
	'pharmacy' => Pharmacy::class,
	'veterinaryCare' => VeterinaryCare::class,
	'diagnosticLab' => DiagnosticLab::class,
	'researchProject' => ResearchProject::class,
	'fundingAgency' => FundingAgency::class,
	'danceGroup' => DanceGroup::class,
	'theaterGroup' => TheaterGroup::class,
	'musicGroup' => MusicGroup::class,
	'bakery' => Bakery::class,
	'distillery' => Distillery::class,
	'winery' => Winery::class,
	'barOrPub' => BarOrPub::class,
	'cafeOrCoffeeShop' => CafeOrCoffeeShop::class,
	'iceCreamShop' => IceCreamShop::class,
	'restaurant' => Restaurant::class,
	'fastFoodRestaurant' => FastFoodRestaurant::class,
	'brewery' => Brewery::class,
	'bowlingAlley' => BowlingAlley::class,
	'golfCourse' => GolfCourse::class,
	'publicSwimmingPool' => PublicSwimmingPool::class,
	'skiResort' => SkiResort::class,
	'exerciseGym' => ExerciseGym::class,
	'sportsClub' => SportsClub::class,
	'tennisComplex' => TennisComplex::class,
	'comedyClub' => ComedyClub::class,
	'artGallery' => ArtGallery::class,
	'nightClub' => NightClub::class,
	'casino' => Casino::class,
	'amusementPark' => AmusementPark::class,
	'adultEntertainment' => AdultEntertainment::class,
	'movieTheater' => MovieTheater::class,
	'autoWash' => AutoWash::class,
	'autoBodyShop' => AutoBodyShop::class,
	'autoRental' => AutoRental::class,
	'autoDealer' => AutoDealer::class,
	'autoPartsStore' => AutoPartsStore::class,
	'motorcycleDealer' => MotorcycleDealer::class,
	'motorcycleRepair' => MotorcycleRepair::class,
	'gasStation' => GasStation::class,
	'autoRepair' => AutoRepair::class,
	'optician' => Optician::class,
	'postOffice' => PostOffice::class,
	'attorney' => Attorney::class,
	'notary' => Notary::class,
	'healthClub' => HealthClub::class,
	'tattooParlor' => TattooParlor::class,
	'daySpa' => DaySpa::class,
	'nailSalon' => NailSalon::class,
	'beautySalon' => BeautySalon::class,
	'hairSalon' => HairSalon::class,
	'campground' => Campground::class,
	'hotel' => Hotel::class,
	'vacationRental' => VacationRental::class,
	'bedAndBreakfast' => BedAndBreakfast::class,
	'motel' => Motel::class,
	'hostel' => Hostel::class,
	'resort' => Resort::class,
	'plumber' => Plumber::class,
	'roofingContractor' => RoofingContractor::class,
	'electrician' => Electrician::class,
	'locksmith' => Locksmith::class,
	'HVACBusiness' => HVACBusiness::class,
	'movingCompany' => MovingCompany::class,
	'housePainter' => HousePainter::class,
	'generalContractor' => GeneralContractor::class,
	'pawnShop' => PawnShop::class,
	'wholesaleStore' => WholesaleStore::class,
	'gardenStore' => GardenStore::class,
	'florist' => Florist::class,
	'toyStore' => ToyStore::class,
	'mobilePhoneStore' => MobilePhoneStore::class,
	'mensClothingStore' => MensClothingStore::class,
	'departmentStore' => DepartmentStore::class,
	'furnitureStore' => FurnitureStore::class,
	'groceryStore' => GroceryStore::class,
	'homeGoodsStore' => HomeGoodsStore::class,
	'bikeStore' => BikeStore::class,
	'jewelryStore' => JewelryStore::class,
	'liquorStore' => LiquorStore::class,
	'movieRentalStore' => MovieRentalStore::class,
	'hobbyShop' => HobbyShop::class,
	'petStore' => PetStore::class,
	'sportingGoodsStore' => SportingGoodsStore::class,
	'officeEquipmentStore' => OfficeEquipmentStore::class,
	'shoeStore' => ShoeStore::class,
	'musicStore' => MusicStore::class,
	'convenienceStore' => ConvenienceStore::class,
	'tireShop' => TireShop::class,
	'electronicsStore' => ElectronicsStore::class,
	'computerStore' => ComputerStore::class,
	'hardwareStore' => HardwareStore::class,
	'outletStore' => OutletStore::class,
	'bookStore' => BookStore::class,
	'clothingStore' => ClothingStore::class,
	'policeStation' => PoliceStation::class,
	'fireStation' => FireStation::class,
	'hospital' => Hospital::class,
	'accountingService' => AccountingService::class,
	'automatedTeller' => AutomatedTeller::class,
	'insuranceAgency' => InsuranceAgency::class,
	'bankOrCreditUnion' => BankOrCreditUnion::class,
	'covidTestingFacility' => CovidTestingFacility::class,
	'physiciansOffice' => PhysiciansOffice::class,
	'individualPhysician' => IndividualPhysician::class,
])]
#[ORM\Table(name: '`organization`')]
class Organization extends Thing
{
	/**
	 * The location of, for example, where an event is happening, where an organization is located, or where an action takes place.
	 *
	 * @see https://schema.org/location
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\PostalAddress')]
	#[ApiProperty(types: ['https://schema.org/location'])]
	private ?PostalAddress $location = null;

	/**
	 * Of a \[\[Person\]\], and less typically of an \[\[Organization\]\], to indicate a topic that is known about - suggesting possible expertise but not implying it. We do not distinguish skill levels here, or relate this to educational content, events, objectives or \[\[JobPosting\]\] descriptions.
	 *
	 * @see https://schema.org/knowsAbout
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/knowsAbout'])]
	private ?string $knowsAbout = null;

	/**
	 * A member of an Organization or a ProgramMembership. Organizations can be members of organizations; ProgramMembership is typically for individuals.
	 *
	 * @see https://schema.org/member
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/member'])]
	#[Assert\NotNull]
	private Person $member;

	/**
	 * Statement on diversity policy by an \[\[Organization\]\] e.g. a \[\[NewsMediaOrganization\]\]. For a \[\[NewsMediaOrganization\]\], a statement describing the newsroom’s diversity policy on both staffing and sources, typically providing staffing data.
	 *
	 * @see https://schema.org/diversityPolicy
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/diversityPolicy'])]
	#[Assert\Url]
	private ?string $diversityPolicy = null;

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
	 * A person who founded this organization.
	 *
	 * @see https://schema.org/founder
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/founder'])]
	#[Assert\NotNull]
	private Person $founder;

	/**
	 * @var Collection<Text>|null The International Standard of Industrial Classification of All Economic Activities (ISIC), Revision 4 code for a particular organization, business person, or place.
	 * @see https://schema.org/isicV4
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinTable(name: 'organization_text_isic_v4')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/isicV4'])]
	private ?Collection $isicV4 = null;

	/**
	 * Physical address of the item.
	 *
	 * @see https://schema.org/address
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/address'])]
	private ?string $address = null;

	/**
	 * For an \[\[Organization\]\] (often but not necessarily a \[\[NewsMediaOrganization\]\]), a report on staffing diversity issues. In a news context this might be for example ASNE or RTDNA (US) reports, or self-reported.
	 *
	 * @see https://schema.org/diversityStaffingReport
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Article')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/diversityStaffingReport'])]
	#[Assert\NotNull]
	private Article $diversityStaffingReport;

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
	 * For a \[\[NewsMediaOrganization\]\] or other news-related \[\[Organization\]\], a statement about public engagement activities (for news media, the newsroom’s), including involving the public - digitally or otherwise -- in coverage decisions, reporting and activities after publication.
	 *
	 * @see https://schema.org/actionableFeedbackPolicy
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWork')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/actionableFeedbackPolicy'])]
	#[Assert\NotNull]
	private CreativeWork $actionableFeedbackPolicy;

	/**
	 * For an \[\[Organization\]\] (typically a \[\[NewsMediaOrganization\]\]), a statement about policy on use of unnamed sources and the decision process required.
	 *
	 * @see https://schema.org/unnamedSourcesPolicy
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/unnamedSourcesPolicy'])]
	#[Assert\Url]
	private ?string $unnamedSourcesPolicy = null;

	/**
	 * An organization identifier that uniquely identifies a legal entity as defined in ISO 17442.
	 *
	 * @see https://schema.org/leiCode
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/leiCode'])]
	private ?string $leiCode = null;

	/**
	 * Certification information about a product, organization, service, place, or person.
	 *
	 * @see https://schema.org/hasCertification
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Certification')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/hasCertification'])]
	#[Assert\NotNull]
	private Certification $hasCertification;

	/**
	 * The number of employees in an organization, e.g. business.
	 *
	 * @see https://schema.org/numberOfEmployees
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
	#[ApiProperty(types: ['https://schema.org/numberOfEmployees'])]
	private ?QuantitativeValue $numberOfEmployees = null;

	/**
	 * An organization identifier as defined in \[ISO 6523(-1)\](https://en.wikipedia.org/wiki/ISO/IEC\_6523). The identifier should be in the `XXXX:YYYYYY:ZZZ` or `XXXX:YYYYYY`format. Where `XXXX` is a 4 digit \_ICD\_ (International Code Designator), `YYYYYY` is an \_OID\_ (Organization Identifier) with all formatting characters (dots, dashes, spaces) removed with a maximal length of 35 characters, and `ZZZ` is an optional OPI (Organization Part Identifier) with a maximum length of 35 characters. The various components (ICD, OID, OPI) are joined with a colon character (ASCII `0x3a`). Note that many existing organization identifiers defined as attributes like \[leiCode\](https://schema.org/leiCode) (`0199`), \[duns\](https://schema.org/duns) (`0060`) or \[GLN\](https://schema.org/globalLocationNumber) (`0088`) can be expressed using ISO-6523. If possible, ISO-6523 codes should be preferred to populating \[vatID\](https://schema.org/vatID) or \[taxID\](https://schema.org/taxID), as ISO identifiers are less ambiguous.
	 *
	 * @see https://schema.org/iso6523Code
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/iso6523Code'])]
	private ?string $iso6523Code = null;

	/**
	 * An associated logo.
	 *
	 * @see https://schema.org/logo
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/logo'])]
	#[Assert\Url]
	private ?string $logo = null;

	/**
	 * The Value-added Tax ID of the organization or person.
	 *
	 * @see https://schema.org/vatID
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/vatID'])]
	private ?string $vatID = null;

	/**
	 * A contact point for a person or organization.
	 *
	 * @see https://schema.org/contactPoint
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\ContactPoint')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/contactPoint'])]
	#[Assert\NotNull]
	private ContactPoint $contactPoint;

	/**
	 * An Organization (or ProgramMembership) to which this Person or Organization belongs.
	 *
	 * @see https://schema.org/memberOf
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\ProgramMembership')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/memberOf'])]
	#[Assert\NotNull]
	private ProgramMembership $memberOf;

	/**
	 * @var Collection<Place>|null Points-of-Sales operated by the organization or person.
	 * @see https://schema.org/hasPOS
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Place')]
	#[ORM\JoinTable(name: 'organization_place_has_pos')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/hasPOS'])]
	private ?Collection $hasPOS = null;

	/**
	 * The telephone number.
	 *
	 * @see https://schema.org/telephone
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/telephone'])]
	private ?string $telephone = null;

	/**
	 * Someone working for this organization.
	 *
	 * @see https://schema.org/employee
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/employee'])]
	#[Assert\NotNull]
	private Person $employee;

	/**
	 * Indicates an OfferCatalog listing for this Organization, Person, or Service.
	 *
	 * @see https://schema.org/hasOfferCatalog
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\OfferCatalog')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/hasOfferCatalog'])]
	#[Assert\NotNull]
	private OfferCatalog $hasOfferCatalog;

	/**
	 * @var Collection<Demand>|null A pointer to products or services sought by the organization or person (demand).
	 * @see https://schema.org/seeks
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Demand')]
	#[ORM\JoinTable(name: 'organization_demand_seeks')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/seeks'])]
	private ?Collection $seeks = null;

	/**
	 * Email address.
	 *
	 * @see https://schema.org/email
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/email'])]
	#[Assert\Email]
	private ?string $email = null;

	/**
	 * For an \[\[Organization\]\] (e.g. \[\[NewsMediaOrganization\]\]), a statement describing (in news media, the newsroom’s) disclosure and correction policy for errors.
	 *
	 * @see https://schema.org/correctionsPolicy
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/correctionsPolicy'])]
	#[Assert\Url]
	private ?string $correctionsPolicy = null;

	/**
	 * The overall rating, based on a collection of reviews or ratings, of the item.
	 *
	 * @see https://schema.org/aggregateRating
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\AggregateRating')]
	#[ApiProperty(types: ['https://schema.org/aggregateRating'])]
	private ?AggregateRating $aggregateRating = null;

	/**
	 * Statement about ethics policy, e.g. of a \[\[NewsMediaOrganization\]\] regarding journalistic and publishing practices, or of a \[\[Restaurant\]\], a page describing food source policies. In the case of a \[\[NewsMediaOrganization\]\], an ethicsPolicy is typically a statement describing the personal, organizational, and corporate standards of behavior expected by the organization.
	 *
	 * @see https://schema.org/ethicsPolicy
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWork')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/ethicsPolicy'])]
	#[Assert\NotNull]
	private CreativeWork $ethicsPolicy;

	/**
	 * The Dun &amp; Bradstreet DUNS number for identifying an organization or business person.
	 *
	 * @see https://schema.org/duns
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/duns'])]
	private ?string $duns = null;

	/**
	 * For an \[\[Organization\]\] (often but not necessarily a \[\[NewsMediaOrganization\]\]), a description of organizational ownership structure; funding and grants. In a news/media setting, this is with particular reference to editorial independence. Note that the \[\[funder\]\] is also available and can be used to make basic funder information machine-readable.
	 *
	 * @see https://schema.org/ownershipFundingInfo
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\AboutPage')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/ownershipFundingInfo'])]
	#[Assert\NotNull]
	private AboutPage $ownershipFundingInfo;

	/**
	 * An award won by or for this item.
	 *
	 * @see https://schema.org/award
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/award'])]
	private ?string $award = null;

	/**
	 * Keywords or tags used to describe some item. Multiple textual entries in a keywords list are typically delimited by commas, or by repeating the property.
	 *
	 * @see https://schema.org/keywords
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/keywords'])]
	private ?string $keywords = null;

	/**
	 * The date that this organization was dissolved.
	 *
	 * @see https://schema.org/dissolutionDate
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
	#[ApiProperty(types: ['https://schema.org/dissolutionDate'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $dissolutionDate = null;

	/**
	 * The fax number.
	 *
	 * @see https://schema.org/faxNumber
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/faxNumber'])]
	private ?string $faxNumber = null;

	/**
	 * The \[Global Location Number\](http://www.gs1.org/gln) (GLN, sometimes also referred to as International Location Number or ILN) of the respective organization, person, or place. The GLN is a 13-digit number used to identify parties and physical locations.
	 *
	 * @see https://schema.org/globalLocationNumber
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/globalLocationNumber'])]
	private ?string $globalLocationNumber = null;

	/**
	 * @var Collection<Text>|null The North American Industry Classification System (NAICS) code for a particular organization or business person.
	 * @see https://schema.org/naics
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinTable(name: 'organization_text_naics')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/naics'])]
	private ?Collection $naics = null;

	/**
	 * A relationship between an organization and a department of that organization, also described as an organization (allowing different urls, logos, opening hours). For example: a store with a pharmacy, or a bakery with a cafe.
	 *
	 * @see https://schema.org/department
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/department'])]
	#[Assert\NotNull]
	private Organization $department;

	/**
	 * The Tax / Fiscal ID of the organization or person, e.g. the TIN in the US or the CIF/NIF in Spain.
	 *
	 * @see https://schema.org/taxID
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/taxID'])]
	private ?string $taxID = null;

	/**
	 * The official name of the organization, e.g. the registered company name.
	 *
	 * @see https://schema.org/legalName
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/legalName'])]
	private ?string $legalName = null;

	/**
	 * A slogan or motto associated with the item.
	 *
	 * @see https://schema.org/slogan
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/slogan'])]
	private ?string $slogan = null;

	/**
	 * The geographic area where a service or offered item is provided.
	 *
	 * @see https://schema.org/areaServed
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/areaServed'])]
	private ?string $areaServed = null;

	/**
	 * A credential awarded to the Person or Organization.
	 *
	 * @see https://schema.org/hasCredential
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\EducationalOccupationalCredential')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/hasCredential'])]
	#[Assert\NotNull]
	private EducationalOccupationalCredential $hasCredential;

	/**
	 * Of a \[\[Person\]\], and less typically of an \[\[Organization\]\], to indicate a known language. We do not distinguish skill levels or reading/writing/speaking/signing here. Use language codes from the \[IETF BCP 47 standard\](http://tools.ietf.org/html/bcp47).
	 *
	 * @see https://schema.org/knowsLanguage
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Language')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/knowsLanguage'])]
	#[Assert\NotNull]
	private Language $knowsLanguage;

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
	 * Upcoming or past event associated with this place, organization, or action.
	 *
	 * @see https://schema.org/event
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Event')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/event'])]
	#[Assert\NotNull]
	private Event $event;

	/**
	 * @var Collection<Organization>|null The brand(s) associated with a product or service, or the brand(s) maintained by an organization or business person.
	 * @see https://schema.org/brand
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Organization')]
	#[ORM\JoinTable(name: 'organization_organization_brand')]
	#[ORM\InverseJoinColumn(name: 'brand_organization_id', unique: true)]
	#[ApiProperty(types: ['https://schema.org/brand'])]
	private ?Collection $brand = null;

	/**
	 * The number of completed interactions for this entity, in a particular role (the 'agent'), in a particular action (indicated in the statistic), and in a particular context (i.e. interactionService).
	 *
	 * @see https://schema.org/agentInteractionStatistic
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\InteractionCounter')]
	#[ApiProperty(types: ['https://schema.org/agentInteractionStatistic'])]
	private ?InteractionCounter $agentInteractionStatistic = null;

	/**
	 * The larger organization that this organization is a \[\[subOrganization\]\] of, if any.
	 *
	 * @see https://schema.org/parentOrganization
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ApiProperty(types: ['https://schema.org/parentOrganization'])]
	private ?Organization $parentOrganization = null;

	/**
	 * nonprofitStatus indicates the legal status of a non-profit organization in its primary place of business.
	 *
	 * @see https://schema.org/nonprofitStatus
	 */
	#[ORM\Column]
	#[ApiProperty(types: ['https://schema.org/nonprofitStatus'])]
	#[Assert\NotNull]
	#[Assert\Choice(callback: [NonprofitType::class, 'toArray'])]
	private string $nonprofitStatus;

	/**
	 * The number of interactions for the CreativeWork using the WebSite or SoftwareApplication. The most specific child type of InteractionCounter should be used.
	 *
	 * @see https://schema.org/interactionStatistic
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\InteractionCounter')]
	#[ApiProperty(types: ['https://schema.org/interactionStatistic'])]
	private ?InteractionCounter $interactionStatistic = null;

	/**
	 * The place where the Organization was founded.
	 *
	 * @see https://schema.org/foundingLocation
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Place')]
	#[ApiProperty(types: ['https://schema.org/foundingLocation'])]
	private ?Place $foundingLocation = null;

	/**
	 * The date that this organization was founded.
	 *
	 * @see https://schema.org/foundingDate
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
	#[ApiProperty(types: ['https://schema.org/foundingDate'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $foundingDate = null;

	/**
	 * @var Collection<OwnershipInfo>|null Products owned by the organization or person.
	 * @see https://schema.org/owns
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\OwnershipInfo')]
	#[ORM\JoinTable(name: 'organization_ownership_info_owns')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/owns'])]
	private ?Collection $owns = null;

	/**
	 * Specifies a MerchantReturnPolicy that may be applicable.
	 *
	 * @see https://schema.org/hasMerchantReturnPolicy
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MerchantReturnPolicy')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/hasMerchantReturnPolicy'])]
	#[Assert\NotNull]
	private MerchantReturnPolicy $hasMerchantReturnPolicy;

	/**
	 * Alumni of an organization.
	 *
	 * @see https://schema.org/alumni
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/alumni'])]
	#[Assert\NotNull]
	private Person $alumni;

	/**
	 * @var Collection<Offer>|null A pointer to products or services offered by the organization or person.
	 * @see https://schema.org/makesOffer
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Offer')]
	#[ORM\JoinTable(name: 'organization_offer_makes_offer')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/makesOffer'])]
	private ?Collection $makesOffer = null;

	/**
	 * A relationship between two organizations where the first includes the second, e.g., as a subsidiary. See also: the more specific 'department' property.
	 *
	 * @see https://schema.org/subOrganization
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/subOrganization'])]
	#[Assert\NotNull]
	private Organization $subOrganization;

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

	function __construct()
	{
		$this->isicV4 = new ArrayCollection();
		$this->hasPOS = new ArrayCollection();
		$this->seeks = new ArrayCollection();
		$this->naics = new ArrayCollection();
		$this->brand = new ArrayCollection();
		$this->owns = new ArrayCollection();
		$this->makesOffer = new ArrayCollection();
	}

	public function setLocation(?PostalAddress $location): void
	{
		$this->location = $location;
	}

	public function getLocation(): ?PostalAddress
	{
		return $this->location;
	}

	public function setKnowsAbout(?string $knowsAbout): void
	{
		$this->knowsAbout = $knowsAbout;
	}

	public function getKnowsAbout(): ?string
	{
		return $this->knowsAbout;
	}

	public function setMember(Person $member): void
	{
		$this->member = $member;
	}

	public function getMember(): Person
	{
		return $this->member;
	}

	public function setDiversityPolicy(?string $diversityPolicy): void
	{
		$this->diversityPolicy = $diversityPolicy;
	}

	public function getDiversityPolicy(): ?string
	{
		return $this->diversityPolicy;
	}

	public function setPublishingPrinciples(?string $publishingPrinciples): void
	{
		$this->publishingPrinciples = $publishingPrinciples;
	}

	public function getPublishingPrinciples(): ?string
	{
		return $this->publishingPrinciples;
	}

	public function setFounder(Person $founder): void
	{
		$this->founder = $founder;
	}

	public function getFounder(): Person
	{
		return $this->founder;
	}

	public function addIsicV4(string $isicV4): void
	{
		$this->isicV4[] = $isicV4;
	}

	public function removeIsicV4(string $isicV4): void
	{
		$this->isicV4->removeElement($isicV4);
	}

	/**
	 * @return Collection<Text>|null
	 */
	public function getIsicV4(): Collection
	{
		return $this->isicV4;
	}

	public function setAddress(?string $address): void
	{
		$this->address = $address;
	}

	public function getAddress(): ?string
	{
		return $this->address;
	}

	public function setDiversityStaffingReport(Article $diversityStaffingReport): void
	{
		$this->diversityStaffingReport = $diversityStaffingReport;
	}

	public function getDiversityStaffingReport(): Article
	{
		return $this->diversityStaffingReport;
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

	public function setActionableFeedbackPolicy(CreativeWork $actionableFeedbackPolicy): void
	{
		$this->actionableFeedbackPolicy = $actionableFeedbackPolicy;
	}

	public function getActionableFeedbackPolicy(): CreativeWork
	{
		return $this->actionableFeedbackPolicy;
	}

	public function setUnnamedSourcesPolicy(?string $unnamedSourcesPolicy): void
	{
		$this->unnamedSourcesPolicy = $unnamedSourcesPolicy;
	}

	public function getUnnamedSourcesPolicy(): ?string
	{
		return $this->unnamedSourcesPolicy;
	}

	public function setLeiCode(?string $leiCode): void
	{
		$this->leiCode = $leiCode;
	}

	public function getLeiCode(): ?string
	{
		return $this->leiCode;
	}

	public function setHasCertification(Certification $hasCertification): void
	{
		$this->hasCertification = $hasCertification;
	}

	public function getHasCertification(): Certification
	{
		return $this->hasCertification;
	}

	public function setNumberOfEmployees(?QuantitativeValue $numberOfEmployees): void
	{
		$this->numberOfEmployees = $numberOfEmployees;
	}

	public function getNumberOfEmployees(): ?QuantitativeValue
	{
		return $this->numberOfEmployees;
	}

	public function setIso6523Code(?string $iso6523Code): void
	{
		$this->iso6523Code = $iso6523Code;
	}

	public function getIso6523Code(): ?string
	{
		return $this->iso6523Code;
	}

	public function setLogo(?string $logo): void
	{
		$this->logo = $logo;
	}

	public function getLogo(): ?string
	{
		return $this->logo;
	}

	public function setVatID(?string $vatID): void
	{
		$this->vatID = $vatID;
	}

	public function getVatID(): ?string
	{
		return $this->vatID;
	}

	public function setContactPoint(ContactPoint $contactPoint): void
	{
		$this->contactPoint = $contactPoint;
	}

	public function getContactPoint(): ContactPoint
	{
		return $this->contactPoint;
	}

	public function setMemberOf(ProgramMembership $memberOf): void
	{
		$this->memberOf = $memberOf;
	}

	public function getMemberOf(): ProgramMembership
	{
		return $this->memberOf;
	}

	public function addHasPO(Place $hasPO): void
	{
		$this->hasPOS[] = $hasPO;
	}

	public function removeHasPO(Place $hasPO): void
	{
		$this->hasPOS->removeElement($hasPO);
	}

	/**
	 * @return Collection<Place>|null
	 */
	public function getHasPOS(): Collection
	{
		return $this->hasPOS;
	}

	public function setTelephone(?string $telephone): void
	{
		$this->telephone = $telephone;
	}

	public function getTelephone(): ?string
	{
		return $this->telephone;
	}

	public function setEmployee(Person $employee): void
	{
		$this->employee = $employee;
	}

	public function getEmployee(): Person
	{
		return $this->employee;
	}

	public function setHasOfferCatalog(OfferCatalog $hasOfferCatalog): void
	{
		$this->hasOfferCatalog = $hasOfferCatalog;
	}

	public function getHasOfferCatalog(): OfferCatalog
	{
		return $this->hasOfferCatalog;
	}

	public function addSeek(Demand $seek): void
	{
		$this->seeks[] = $seek;
	}

	public function removeSeek(Demand $seek): void
	{
		$this->seeks->removeElement($seek);
	}

	/**
	 * @return Collection<Demand>|null
	 */
	public function getSeeks(): Collection
	{
		return $this->seeks;
	}

	public function setEmail(?string $email): void
	{
		$this->email = $email;
	}

	public function getEmail(): ?string
	{
		return $this->email;
	}

	public function setCorrectionsPolicy(?string $correctionsPolicy): void
	{
		$this->correctionsPolicy = $correctionsPolicy;
	}

	public function getCorrectionsPolicy(): ?string
	{
		return $this->correctionsPolicy;
	}

	public function setAggregateRating(?AggregateRating $aggregateRating): void
	{
		$this->aggregateRating = $aggregateRating;
	}

	public function getAggregateRating(): ?AggregateRating
	{
		return $this->aggregateRating;
	}

	public function setEthicsPolicy(CreativeWork $ethicsPolicy): void
	{
		$this->ethicsPolicy = $ethicsPolicy;
	}

	public function getEthicsPolicy(): CreativeWork
	{
		return $this->ethicsPolicy;
	}

	public function setDuns(?string $duns): void
	{
		$this->duns = $duns;
	}

	public function getDuns(): ?string
	{
		return $this->duns;
	}

	public function setOwnershipFundingInfo(AboutPage $ownershipFundingInfo): void
	{
		$this->ownershipFundingInfo = $ownershipFundingInfo;
	}

	public function getOwnershipFundingInfo(): AboutPage
	{
		return $this->ownershipFundingInfo;
	}

	public function setAward(?string $award): void
	{
		$this->award = $award;
	}

	public function getAward(): ?string
	{
		return $this->award;
	}

	public function setKeywords(?string $keywords): void
	{
		$this->keywords = $keywords;
	}

	public function getKeywords(): ?string
	{
		return $this->keywords;
	}

	public function setDissolutionDate(?\DateTimeInterface $dissolutionDate): void
	{
		$this->dissolutionDate = $dissolutionDate;
	}

	public function getDissolutionDate(): ?\DateTimeInterface
	{
		return $this->dissolutionDate;
	}

	public function setFaxNumber(?string $faxNumber): void
	{
		$this->faxNumber = $faxNumber;
	}

	public function getFaxNumber(): ?string
	{
		return $this->faxNumber;
	}

	public function setGlobalLocationNumber(?string $globalLocationNumber): void
	{
		$this->globalLocationNumber = $globalLocationNumber;
	}

	public function getGlobalLocationNumber(): ?string
	{
		return $this->globalLocationNumber;
	}

	public function addNaic(string $naic): void
	{
		$this->naics[] = $naic;
	}

	public function removeNaic(string $naic): void
	{
		$this->naics->removeElement($naic);
	}

	/**
	 * @return Collection<Text>|null
	 */
	public function getNaics(): Collection
	{
		return $this->naics;
	}

	public function setDepartment(Organization $department): void
	{
		$this->department = $department;
	}

	public function getDepartment(): Organization
	{
		return $this->department;
	}

	public function setTaxID(?string $taxID): void
	{
		$this->taxID = $taxID;
	}

	public function getTaxID(): ?string
	{
		return $this->taxID;
	}

	public function setLegalName(?string $legalName): void
	{
		$this->legalName = $legalName;
	}

	public function getLegalName(): ?string
	{
		return $this->legalName;
	}

	public function setSlogan(?string $slogan): void
	{
		$this->slogan = $slogan;
	}

	public function getSlogan(): ?string
	{
		return $this->slogan;
	}

	public function setAreaServed(?string $areaServed): void
	{
		$this->areaServed = $areaServed;
	}

	public function getAreaServed(): ?string
	{
		return $this->areaServed;
	}

	public function setHasCredential(EducationalOccupationalCredential $hasCredential): void
	{
		$this->hasCredential = $hasCredential;
	}

	public function getHasCredential(): EducationalOccupationalCredential
	{
		return $this->hasCredential;
	}

	public function setKnowsLanguage(Language $knowsLanguage): void
	{
		$this->knowsLanguage = $knowsLanguage;
	}

	public function getKnowsLanguage(): Language
	{
		return $this->knowsLanguage;
	}

	public function setReview(Review $review): void
	{
		$this->review = $review;
	}

	public function getReview(): Review
	{
		return $this->review;
	}

	public function setEvent(Event $event): void
	{
		$this->event = $event;
	}

	public function getEvent(): Event
	{
		return $this->event;
	}

	public function addBrand(Organization $brand): void
	{
		$this->brand[] = $brand;
	}

	public function removeBrand(Organization $brand): void
	{
		$this->brand->removeElement($brand);
	}

	/**
	 * @return Collection<Organization>|null
	 */
	public function getBrand(): Collection
	{
		return $this->brand;
	}

	public function setAgentInteractionStatistic(?InteractionCounter $agentInteractionStatistic): void
	{
		$this->agentInteractionStatistic = $agentInteractionStatistic;
	}

	public function getAgentInteractionStatistic(): ?InteractionCounter
	{
		return $this->agentInteractionStatistic;
	}

	public function setParentOrganization(?Organization $parentOrganization): void
	{
		$this->parentOrganization = $parentOrganization;
	}

	public function getParentOrganization(): ?Organization
	{
		return $this->parentOrganization;
	}

	public function setNonprofitStatus(string $nonprofitStatus): void
	{
		$this->nonprofitStatus = $nonprofitStatus;
	}

	public function getNonprofitStatus(): string
	{
		return $this->nonprofitStatus;
	}

	public function setInteractionStatistic(?InteractionCounter $interactionStatistic): void
	{
		$this->interactionStatistic = $interactionStatistic;
	}

	public function getInteractionStatistic(): ?InteractionCounter
	{
		return $this->interactionStatistic;
	}

	public function setFoundingLocation(?Place $foundingLocation): void
	{
		$this->foundingLocation = $foundingLocation;
	}

	public function getFoundingLocation(): ?Place
	{
		return $this->foundingLocation;
	}

	public function setFoundingDate(?\DateTimeInterface $foundingDate): void
	{
		$this->foundingDate = $foundingDate;
	}

	public function getFoundingDate(): ?\DateTimeInterface
	{
		return $this->foundingDate;
	}

	public function addOwn(OwnershipInfo $own): void
	{
		$this->owns[] = $own;
	}

	public function removeOwn(OwnershipInfo $own): void
	{
		$this->owns->removeElement($own);
	}

	/**
	 * @return Collection<OwnershipInfo>|null
	 */
	public function getOwns(): Collection
	{
		return $this->owns;
	}

	public function setHasMerchantReturnPolicy(MerchantReturnPolicy $hasMerchantReturnPolicy): void
	{
		$this->hasMerchantReturnPolicy = $hasMerchantReturnPolicy;
	}

	public function getHasMerchantReturnPolicy(): MerchantReturnPolicy
	{
		return $this->hasMerchantReturnPolicy;
	}

	public function setAlumni(Person $alumni): void
	{
		$this->alumni = $alumni;
	}

	public function getAlumni(): Person
	{
		return $this->alumni;
	}

	public function addMakesOffer(Offer $makesOffer): void
	{
		$this->makesOffer[] = $makesOffer;
	}

	public function removeMakesOffer(Offer $makesOffer): void
	{
		$this->makesOffer->removeElement($makesOffer);
	}

	/**
	 * @return Collection<Offer>|null
	 */
	public function getMakesOffer(): Collection
	{
		return $this->makesOffer;
	}

	public function setSubOrganization(Organization $subOrganization): void
	{
		$this->subOrganization = $subOrganization;
	}

	public function getSubOrganization(): Organization
	{
		return $this->subOrganization;
	}

	public function setFunding(Grant $funding): void
	{
		$this->funding = $funding;
	}

	public function getFunding(): Grant
	{
		return $this->funding;
	}
}
