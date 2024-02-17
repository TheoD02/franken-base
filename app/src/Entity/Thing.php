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
 * The most generic type of item.
 *
 * @see https://schema.org/Thing
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
	'thing' => Thing::class,
	'action' => Action::class,
	'event' => Event::class,
	'person' => Person::class,
	'taxon' => Taxon::class,
	'creativeWork' => CreativeWork::class,
	'product' => Product::class,
	'place' => Place::class,
	'medicalEntity' => MedicalEntity::class,
	'organization' => Organization::class,
	'bioChemEntity' => BioChemEntity::class,
	'seekToAction' => SeekToAction::class,
	'searchAction' => SearchAction::class,
	'solveMathAction' => SolveMathAction::class,
	'danceEvent' => DanceEvent::class,
	'saleEvent' => SaleEvent::class,
	'eventSeries' => EventSeries::class,
	'hackathon' => Hackathon::class,
	'literaryEvent' => LiteraryEvent::class,
	'musicEvent' => MusicEvent::class,
	'theaterEvent' => TheaterEvent::class,
	'socialEvent' => SocialEvent::class,
	'childrensEvent' => ChildrensEvent::class,
	'comedyEvent' => ComedyEvent::class,
	'visualArtsEvent' => VisualArtsEvent::class,
	'festival' => Festival::class,
	'businessEvent' => BusinessEvent::class,
	'exhibitionEvent' => ExhibitionEvent::class,
	'foodEvent' => FoodEvent::class,
	'sportsEvent' => SportsEvent::class,
	'screeningEvent' => ScreeningEvent::class,
	'educationEvent' => EducationEvent::class,
	'deliveryEvent' => DeliveryEvent::class,
	'courseInstance' => CourseInstance::class,
	'publicationEvent' => PublicationEvent::class,
	'patient' => Patient::class,
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
	'vehicle' => Vehicle::class,
	'dietarySupplement' => DietarySupplement::class,
	'drug' => Drug::class,
	'individualProduct' => IndividualProduct::class,
	'someProducts' => SomeProducts::class,
	'productModel' => ProductModel::class,
	'productGroup' => ProductGroup::class,
	'landmarksOrHistoricalBuildings' => LandmarksOrHistoricalBuildings::class,
	'accommodation' => Accommodation::class,
	'civicStructure' => CivicStructure::class,
	'touristDestination' => TouristDestination::class,
	'touristAttraction' => TouristAttraction::class,
	'administrativeArea' => AdministrativeArea::class,
	'medicalGuideline' => MedicalGuideline::class,
	'medicalRiskFactor' => MedicalRiskFactor::class,
	'substance' => Substance::class,
	'medicalContraindication' => MedicalContraindication::class,
	'superficialAnatomy' => SuperficialAnatomy::class,
	'anatomicalStructure' => AnatomicalStructure::class,
	'medicalDevice' => MedicalDevice::class,
	'anatomicalSystem' => AnatomicalSystem::class,
	'medicalTest' => MedicalTest::class,
	'drugCost' => DrugCost::class,
	'medicalStudy' => MedicalStudy::class,
	'drugClass' => DrugClass::class,
	'medicalCause' => MedicalCause::class,
	'medicalCondition' => MedicalCondition::class,
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
	'chemicalSubstance' => ChemicalSubstance::class,
	'gene' => Gene::class,
	'protein' => Protein::class,
	'molecularEntity' => MolecularEntity::class,
	'menuItem' => MenuItem::class,
	'programMembership' => ProgramMembership::class,
	'speakableSpecification' => SpeakableSpecification::class,
	'merchantReturnPolicySeasonalOverride' => MerchantReturnPolicySeasonalOverride::class,
	'reservation' => Reservation::class,
	'propertyValueSpecification' => PropertyValueSpecification::class,
	'itemList' => ItemList::class,
	'occupation' => Occupation::class,
	'class' => Class_::class,
	'virtualLocation' => VirtualLocation::class,
	'healthPlanFormulary' => HealthPlanFormulary::class,
	'bedDetails' => BedDetails::class,
	'definedTerm' => DefinedTerm::class,
	'serviceChannel' => ServiceChannel::class,
	'jobPosting' => JobPosting::class,
	'merchantReturnPolicy' => MerchantReturnPolicy::class,
	'parcelDelivery' => ParcelDelivery::class,
	'property' => Property::class,
	'healthInsurancePlan' => HealthInsurancePlan::class,
	'seat' => Seat::class,
	'demand' => Demand::class,
	'language' => Language::class,
	'enumeration' => Enumeration::class,
	'dataFeedItem' => DataFeedItem::class,
	'computerLanguage' => ComputerLanguage::class,
	'schedule' => Schedule::class,
	'floorPlan' => FloorPlan::class,
	'broadcastChannel' => BroadcastChannel::class,
	'healthPlanNetwork' => HealthPlanNetwork::class,
	'actionAccessSpecification' => ActionAccessSpecification::class,
	'alignmentObject' => AlignmentObject::class,
	'occupationalExperienceRequirements' => OccupationalExperienceRequirements::class,
	'statisticalPopulation' => StatisticalPopulation::class,
	'gameServer' => GameServer::class,
	'healthPlanCostSharingSpecification' => HealthPlanCostSharingSpecification::class,
	'brand' => Brand::class,
	'ticket' => Ticket::class,
	'grant' => Grant::class,
	'orderItem' => OrderItem::class,
	'energyConsumptionDetails' => EnergyConsumptionDetails::class,
	'audience' => Audience::class,
	'geospatialGeometry' => GeospatialGeometry::class,
	'mediaSubscription' => MediaSubscription::class,
	'broadcastFrequencySpecification' => BroadcastFrequencySpecification::class,
	'structuredValue' => StructuredValue::class,
	'invoice' => Invoice::class,
	'digitalDocumentPermission' => DigitalDocumentPermission::class,
	'rating' => Rating::class,
	'entryPoint' => EntryPoint::class,
	'service' => Service::class,
	'trip' => Trip::class,
	'order' => Order::class,
	'offer' => Offer::class,
	'listItem' => ListItem::class,
	'arriveAction' => ArriveAction::class,
	'departAction' => DepartAction::class,
	'travelAction' => TravelAction::class,
	'tieAction' => TieAction::class,
	'winAction' => WinAction::class,
	'loseAction' => LoseAction::class,
	'exerciseAction' => ExerciseAction::class,
	'performAction' => PerformAction::class,
	'bookmarkAction' => BookmarkAction::class,
	'applyAction' => ApplyAction::class,
	'deleteAction' => DeleteAction::class,
	'replaceAction' => ReplaceAction::class,
	'viewAction' => ViewAction::class,
	'watchAction' => WatchAction::class,
	'installAction' => InstallAction::class,
	'eatAction' => EatAction::class,
	'readAction' => ReadAction::class,
	'listenAction' => ListenAction::class,
	'drinkAction' => DrinkAction::class,
	'playGameAction' => PlayGameAction::class,
	'checkAction' => CheckAction::class,
	'discoverAction' => DiscoverAction::class,
	'trackAction' => TrackAction::class,
	'activateAction' => ActivateAction::class,
	'suspendAction' => SuspendAction::class,
	'deactivateAction' => DeactivateAction::class,
	'resumeAction' => ResumeAction::class,
	'takeAction' => TakeAction::class,
	'downloadAction' => DownloadAction::class,
	'moneyTransfer' => MoneyTransfer::class,
	'sendAction' => SendAction::class,
	'receiveAction' => ReceiveAction::class,
	'borrowAction' => BorrowAction::class,
	'lendAction' => LendAction::class,
	'returnAction' => ReturnAction::class,
	'giveAction' => GiveAction::class,
	'befriendAction' => BefriendAction::class,
	'registerAction' => RegisterAction::class,
	'marryAction' => MarryAction::class,
	'subscribeAction' => SubscribeAction::class,
	'unRegisterAction' => UnRegisterAction::class,
	'leaveAction' => LeaveAction::class,
	'joinAction' => JoinAction::class,
	'followAction' => FollowAction::class,
	'paintAction' => PaintAction::class,
	'filmAction' => FilmAction::class,
	'drawAction' => DrawAction::class,
	'photographAction' => PhotographAction::class,
	'writeAction' => WriteAction::class,
	'cookAction' => CookAction::class,
	'ignoreAction' => IgnoreAction::class,
	'reviewAction' => ReviewAction::class,
	'quoteAction' => QuoteAction::class,
	'preOrderAction' => PreOrderAction::class,
	'buyAction' => BuyAction::class,
	'orderAction' => OrderAction::class,
	'payAction' => PayAction::class,
	'tipAction' => TipAction::class,
	'sellAction' => SellAction::class,
	'rentAction' => RentAction::class,
	'donateAction' => DonateAction::class,
	'userDownloads' => UserDownloads::class,
	'userLikes' => UserLikes::class,
	'userPlays' => UserPlays::class,
	'userTweets' => UserTweets::class,
	'userBlocks' => UserBlocks::class,
	'userPlusOnes' => UserPlusOnes::class,
	'userCheckins' => UserCheckins::class,
	'userPageVisits' => UserPageVisits::class,
	'userComments' => UserComments::class,
	'onDemandEvent' => OnDemandEvent::class,
	'broadcastEvent' => BroadcastEvent::class,
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
	'motorizedBicycle' => MotorizedBicycle::class,
	'motorcycle' => Motorcycle::class,
	'busOrCoach' => BusOrCoach::class,
	'car' => Car::class,
	'campingPitch' => CampingPitch::class,
	'apartment' => Apartment::class,
	'suite' => Suite::class,
	'park' => Park::class,
	'taxiStand' => TaxiStand::class,
	'stadiumOrArena' => StadiumOrArena::class,
	'publicToilet' => PublicToilet::class,
	'subwayStation' => SubwayStation::class,
	'playground' => Playground::class,
	'zoo' => Zoo::class,
	'aquarium' => Aquarium::class,
	'bridge' => Bridge::class,
	'musicVenue' => MusicVenue::class,
	'cemetery' => Cemetery::class,
	'performingArtsTheater' => PerformingArtsTheater::class,
	'parkingFacility' => ParkingFacility::class,
	'eventVenue' => EventVenue::class,
	'crematorium' => Crematorium::class,
	'RVPark' => RVPark::class,
	'museum' => Museum::class,
	'beach' => Beach::class,
	'boatTerminal' => BoatTerminal::class,
	'trainStation' => TrainStation::class,
	'busStop' => BusStop::class,
	'airport' => Airport::class,
	'busStation' => BusStation::class,
	'schoolDistrict' => SchoolDistrict::class,
	'city' => City::class,
	'state' => State::class,
	'country' => Country::class,
	'volcano' => Volcano::class,
	'continent' => Continent::class,
	'mountain' => Mountain::class,
	'gatedResidenceCommunity' => GatedResidenceCommunity::class,
	'apartmentComplex' => ApartmentComplex::class,
	'medicalGuidelineContraindication' => MedicalGuidelineContraindication::class,
	'medicalGuidelineRecommendation' => MedicalGuidelineRecommendation::class,
	'approvedIndication' => ApprovedIndication::class,
	'preventionIndication' => PreventionIndication::class,
	'treatmentIndication' => TreatmentIndication::class,
	'bone' => Bone::class,
	'ligament' => Ligament::class,
	'vessel' => Vessel::class,
	'brainStructure' => BrainStructure::class,
	'nerve' => Nerve::class,
	'joint' => Joint::class,
	'muscle' => Muscle::class,
	'surgicalProcedure' => SurgicalProcedure::class,
	'diagnosticProcedure' => DiagnosticProcedure::class,
	'physicalExam' => PhysicalExam::class,
	'bloodTest' => BloodTest::class,
	'pathologyTest' => PathologyTest::class,
	'imagingTest' => ImagingTest::class,
	'medicalTestPanel' => MedicalTestPanel::class,
	'medicalTrial' => MedicalTrial::class,
	'medicalObservationalStudy' => MedicalObservationalStudy::class,
	'medicalConditionStage' => MedicalConditionStage::class,
	'drugLegalStatus' => DrugLegalStatus::class,
	'medicalCode' => MedicalCode::class,
	'doseSchedule' => DoseSchedule::class,
	'dDxElement' => DDxElement::class,
	'drugStrength' => DrugStrength::class,
	'physicalActivity' => PhysicalActivity::class,
	'medicalRiskCalculator' => MedicalRiskCalculator::class,
	'medicalRiskScore' => MedicalRiskScore::class,
	'medicalSignOrSymptom' => MedicalSignOrSymptom::class,
	'infectiousDisease' => InfectiousDisease::class,
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
	'workBasedProgram' => WorkBasedProgram::class,
	'boatReservation' => BoatReservation::class,
	'busReservation' => BusReservation::class,
	'trainReservation' => TrainReservation::class,
	'eventReservation' => EventReservation::class,
	'rentalCarReservation' => RentalCarReservation::class,
	'lodgingReservation' => LodgingReservation::class,
	'foodEstablishmentReservation' => FoodEstablishmentReservation::class,
	'taxiReservation' => TaxiReservation::class,
	'flightReservation' => FlightReservation::class,
	'reservationPackage' => ReservationPackage::class,
	'creativeWorkSeries' => CreativeWorkSeries::class,
	'breadcrumbList' => BreadcrumbList::class,
	'offerCatalog' => OfferCatalog::class,
	'dataType' => DataType::class,
	'categoryCode' => CategoryCode::class,
	'televisionChannel' => TelevisionChannel::class,
	'linkRole' => LinkRole::class,
	'performanceRole' => PerformanceRole::class,
	'monetaryGrant' => MonetaryGrant::class,
	'governmentPermit' => GovernmentPermit::class,
	'energy' => Energy::class,
	'distance' => Distance::class,
	'mass' => Mass::class,
	'duration' => Duration::class,
	'statisticalVariable' => StatisticalVariable::class,
	'researcher' => Researcher::class,
	'educationalAudience' => EducationalAudience::class,
	'businessAudience' => BusinessAudience::class,
	'shippingRateSettings' => ShippingRateSettings::class,
	'shippingDeliveryTime' => ShippingDeliveryTime::class,
	'nutritionInformation' => NutritionInformation::class,
	'warrantyPromise' => WarrantyPromise::class,
	'postalCodeRangeSpecification' => PostalCodeRangeSpecification::class,
	'repaymentSpecification' => RepaymentSpecification::class,
	'openingHoursSpecification' => OpeningHoursSpecification::class,
	'ownershipInfo' => OwnershipInfo::class,
	'typeAndQuantityNode' => TypeAndQuantityNode::class,
	'contactPoint' => ContactPoint::class,
	'interactionCounter' => InteractionCounter::class,
	'engineSpecification' => EngineSpecification::class,
	'geoShape' => GeoShape::class,
	'monetaryAmount' => MonetaryAmount::class,
	'exchangeRateSpecification' => ExchangeRateSpecification::class,
	'datedMoneySpecification' => DatedMoneySpecification::class,
	'propertyValue' => PropertyValue::class,
	'definedRegion' => DefinedRegion::class,
	'deliveryTimeSettings' => DeliveryTimeSettings::class,
	'CDCPMDRecord' => CDCPMDRecord::class,
	'geoCoordinates' => GeoCoordinates::class,
	'offerShippingDetails' => OfferShippingDetails::class,
	'quantitativeValue' => QuantitativeValue::class,
	'priceSpecification' => PriceSpecification::class,
	'endorsementRating' => EndorsementRating::class,
	'aggregateRating' => AggregateRating::class,
	'taxi' => Taxi::class,
	'foodService' => FoodService::class,
	'webAPI' => WebAPI::class,
	'taxiService' => TaxiService::class,
	'broadcastService' => BroadcastService::class,
	'governmentService' => GovernmentService::class,
	'cableOrSatelliteService' => CableOrSatelliteService::class,
	'touristTrip' => TouristTrip::class,
	'busTrip' => BusTrip::class,
	'boatTrip' => BoatTrip::class,
	'trainTrip' => TrainTrip::class,
	'flight' => Flight::class,
	'offerForLease' => OfferForLease::class,
	'offerForPurchase' => OfferForPurchase::class,
	'aggregateOffer' => AggregateOffer::class,
	'howToDirection' => HowToDirection::class,
	'acceptAction' => AcceptAction::class,
	'rejectAction' => RejectAction::class,
	'assignAction' => AssignAction::class,
	'authorizeAction' => AuthorizeAction::class,
	'cancelAction' => CancelAction::class,
	'scheduleAction' => ScheduleAction::class,
	'reserveAction' => ReserveAction::class,
	'wearAction' => WearAction::class,
	'shareAction' => ShareAction::class,
	'checkOutAction' => CheckOutAction::class,
	'checkInAction' => CheckInAction::class,
	'commentAction' => CommentAction::class,
	'replyAction' => ReplyAction::class,
	'askAction' => AskAction::class,
	'inviteAction' => InviteAction::class,
	'dislikeAction' => DislikeAction::class,
	'disagreeAction' => DisagreeAction::class,
	'wantAction' => WantAction::class,
	'agreeAction' => AgreeAction::class,
	'likeAction' => LikeAction::class,
	'endorseAction' => EndorseAction::class,
	'voteAction' => VoteAction::class,
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
	'meetingRoom' => MeetingRoom::class,
	'hotelRoom' => HotelRoom::class,
	'singleFamilyResidence' => SingleFamilyResidence::class,
	'cityHall' => CityHall::class,
	'courthouse' => Courthouse::class,
	'legislativeBuilding' => LegislativeBuilding::class,
	'defenceEstablishment' => DefenceEstablishment::class,
	'embassy' => Embassy::class,
	'synagogue' => Synagogue::class,
	'mosque' => Mosque::class,
	'hinduTemple' => HinduTemple::class,
	'buddhistTemple' => BuddhistTemple::class,
	'seaBodyOfWater' => SeaBodyOfWater::class,
	'lakeBodyOfWater' => LakeBodyOfWater::class,
	'oceanBodyOfWater' => OceanBodyOfWater::class,
	'waterfall' => Waterfall::class,
	'pond' => Pond::class,
	'canal' => Canal::class,
	'reservoir' => Reservoir::class,
	'riverBodyOfWater' => RiverBodyOfWater::class,
	'artery' => Artery::class,
	'vein' => Vein::class,
	'lymphaticVessel' => LymphaticVessel::class,
	'psychologicalTreatment' => PsychologicalTreatment::class,
	'medicalTherapy' => MedicalTherapy::class,
	'reportedDoseSchedule' => ReportedDoseSchedule::class,
	'maximumDoseSchedule' => MaximumDoseSchedule::class,
	'recommendedDoseSchedule' => RecommendedDoseSchedule::class,
	'medicalSymptom' => MedicalSymptom::class,
	'medicalSign' => MedicalSign::class,
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
	'bookSeries' => BookSeries::class,
	'movieSeries' => MovieSeries::class,
	'podcastSeries' => PodcastSeries::class,
	'radioSeries' => RadioSeries::class,
	'videoGameSeries' => VideoGameSeries::class,
	'FMRadioChannel' => FMRadioChannel::class,
	'AMRadioChannel' => AMRadioChannel::class,
	'employeeRole' => EmployeeRole::class,
	'medicalAudience' => MedicalAudience::class,
	'parentAudience' => ParentAudience::class,
	'monetaryAmountDistribution' => MonetaryAmountDistribution::class,
	'postalAddress' => PostalAddress::class,
	'geoCircle' => GeoCircle::class,
	'locationFeatureSpecification' => LocationFeatureSpecification::class,
	'observation' => Observation::class,
	'deliveryChargeSpecification' => DeliveryChargeSpecification::class,
	'compoundPriceSpecification' => CompoundPriceSpecification::class,
	'unitPriceSpecification' => UnitPriceSpecification::class,
	'paymentChargeSpecification' => PaymentChargeSpecification::class,
	'employerAggregateRating' => EmployerAggregateRating::class,
	'currencyConversionService' => CurrencyConversionService::class,
	'paymentService' => PaymentService::class,
	'loanOrCredit' => LoanOrCredit::class,
	'radioBroadcastService' => RadioBroadcastService::class,
	'howToSupply' => HowToSupply::class,
	'howToTool' => HowToTool::class,
	'appendAction' => AppendAction::class,
	'prependAction' => PrependAction::class,
	'confirmAction' => ConfirmAction::class,
	'rsvpAction' => RsvpAction::class,
	'liveBlogPosting' => LiveBlogPosting::class,
	'imageGallery' => ImageGallery::class,
	'videoGallery' => VideoGallery::class,
	'catholicChurch' => CatholicChurch::class,
	'radiationTherapy' => RadiationTherapy::class,
	'occupationalTherapy' => OccupationalTherapy::class,
	'physicalTherapy' => PhysicalTherapy::class,
	'palliativeProcedure' => PalliativeProcedure::class,
	'vitalSign' => VitalSign::class,
	'covidTestingFacility' => CovidTestingFacility::class,
	'physiciansOffice' => PhysiciansOffice::class,
	'individualPhysician' => IndividualPhysician::class,
	'newspaper' => Newspaper::class,
	'comicSeries' => ComicSeries::class,
	'investmentFund' => InvestmentFund::class,
	'brokerageAccount' => BrokerageAccount::class,
	'mortgageLoan' => MortgageLoan::class,
	'creditCard' => CreditCard::class,
	'depositAccount' => DepositAccount::class,
])]
class Thing
{
	#[ORM\Id]
	#[ORM\GeneratedValue(strategy: 'AUTO')]
	#[ORM\Column(type: 'integer')]
	private ?int $id = null;

	/**
	 * The identifier property represents any kind of identifier for any kind of \[\[Thing\]\], such as ISBNs, GTIN codes, UUIDs etc. Schema.org provides dedicated properties for representing many of these, either as textual strings or as URL (URI) links. See \[background notes\](/docs/datamodel.html#identifierBg) for more details.
	 *
	 * @see https://schema.org/identifier
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/identifier'])]
	private ?string $identifier = null;

	/**
	 * A description of the item.
	 *
	 * @see https://schema.org/description
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\TextObject')]
	#[ApiProperty(types: ['https://schema.org/description'])]
	private ?TextObject $description = null;

	/**
	 * An alias for the item.
	 *
	 * @see https://schema.org/alternateName
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/alternateName'])]
	private ?string $alternateName = null;

	/**
	 * URL of the item.
	 *
	 * @see https://schema.org/url
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/url'])]
	#[Assert\Url]
	private ?string $url = null;

	/**
	 * An image of the item. This can be a \[\[URL\]\] or a fully described \[\[ImageObject\]\].
	 *
	 * @see https://schema.org/image
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\ImageObject')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/image'])]
	#[Assert\NotNull]
	private ImageObject $image;

	/**
	 * An additional type for the item, typically used for adding more specific types from external vocabularies in microdata syntax. This is a relationship between something and a class that the thing is in. Typically the value is a URI-identified RDF class, and in this case corresponds to the use of rdf:type in RDF. Text values can be used sparingly, for cases where useful information can be added without their being an appropriate schema to reference. In the case of text values, the class label should follow the schema.org [style guide](https://schema.org/docs/styleguide.html).
	 *
	 * @see https://schema.org/additionalType
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/additionalType'])]
	private ?string $additionalType = null;

	/**
	 * Indicates a potential Action, which describes an idealized action in which this thing would play an 'object' role.
	 *
	 * @see https://schema.org/potentialAction
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Action')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/potentialAction'])]
	#[Assert\NotNull]
	private Action $potentialAction;

	/**
	 * A sub property of description. A short description of the item used to disambiguate from other, similar items. Information from other properties (in particular, name) may be necessary for the description to be useful for disambiguation.
	 *
	 * @see https://schema.org/disambiguatingDescription
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/disambiguatingDescription'])]
	private ?string $disambiguatingDescription = null;

	/**
	 * URL of a reference Web page that unambiguously indicates the item's identity. E.g. the URL of the item's Wikipedia page, Wikidata entry, or official website.
	 *
	 * @see https://schema.org/sameAs
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/sameAs'])]
	#[Assert\Url]
	private ?string $sameAs = null;

	/**
	 * The name of the item.
	 *
	 * @see https://schema.org/name
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/name'])]
	private ?string $name = null;

	/**
	 * Indicates a page (or other CreativeWork) for which this thing is the main entity being described. See \[background notes\](/docs/datamodel.html#mainEntityBackground) for details.
	 *
	 * @see https://schema.org/mainEntityOfPage
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/mainEntityOfPage'])]
	#[Assert\Url]
	private ?string $mainEntityOfPage = null;

	/**
	 * A CreativeWork or Event about this Thing.
	 *
	 * @see https://schema.org/subjectOf
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWork')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/subjectOf'])]
	#[Assert\NotNull]
	private CreativeWork $subjectOf;

	public function getId(): ?int
	{
		return $this->id;
	}

	public function setIdentifier(?string $identifier): void
	{
		$this->identifier = $identifier;
	}

	public function getIdentifier(): ?string
	{
		return $this->identifier;
	}

	public function setDescription(?TextObject $description): void
	{
		$this->description = $description;
	}

	public function getDescription(): ?TextObject
	{
		return $this->description;
	}

	public function setAlternateName(?string $alternateName): void
	{
		$this->alternateName = $alternateName;
	}

	public function getAlternateName(): ?string
	{
		return $this->alternateName;
	}

	public function setUrl(?string $url): void
	{
		$this->url = $url;
	}

	public function getUrl(): ?string
	{
		return $this->url;
	}

	public function setImage(ImageObject $image): void
	{
		$this->image = $image;
	}

	public function getImage(): ImageObject
	{
		return $this->image;
	}

	public function setAdditionalType(?string $additionalType): void
	{
		$this->additionalType = $additionalType;
	}

	public function getAdditionalType(): ?string
	{
		return $this->additionalType;
	}

	public function setPotentialAction(Action $potentialAction): void
	{
		$this->potentialAction = $potentialAction;
	}

	public function getPotentialAction(): Action
	{
		return $this->potentialAction;
	}

	public function setDisambiguatingDescription(?string $disambiguatingDescription): void
	{
		$this->disambiguatingDescription = $disambiguatingDescription;
	}

	public function getDisambiguatingDescription(): ?string
	{
		return $this->disambiguatingDescription;
	}

	public function setSameAs(?string $sameAs): void
	{
		$this->sameAs = $sameAs;
	}

	public function getSameAs(): ?string
	{
		return $this->sameAs;
	}

	public function setName(?string $name): void
	{
		$this->name = $name;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function setMainEntityOfPage(?string $mainEntityOfPage): void
	{
		$this->mainEntityOfPage = $mainEntityOfPage;
	}

	public function getMainEntityOfPage(): ?string
	{
		return $this->mainEntityOfPage;
	}

	public function setSubjectOf(CreativeWork $subjectOf): void
	{
		$this->subjectOf = $subjectOf;
	}

	public function getSubjectOf(): CreativeWork
	{
		return $this->subjectOf;
	}
}
