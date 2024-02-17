<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use App\Enum\ReservationStatusType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Describes a reservation for travel, dining or an event. Some reservations require tickets. \\n\\nNote: This type is for information about actual reservations, e.g. in confirmation emails or HTML pages with individual confirmations of reservations. For offers of tickets, restaurant reservations, flights, or rental cars, use \[\[Offer\]\].
 *
 * @see https://schema.org/Reservation
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
    'reservation' => Reservation::class,
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
])]
class Reservation extends Intangible
{
    /**
     * Any membership in a frequent flyer, hotel loyalty program, etc. being applied to the reservation.
     *
     * @see https://schema.org/programMembershipUsed
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\ProgramMembership')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/programMembershipUsed'])]
    #[Assert\NotNull]
    private ProgramMembership $programMembershipUsed;

    /**
     * A unique identifier for the reservation.
     *
     * @see https://schema.org/reservationId
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/reservationId'])]
    private ?string $reservationId = null;

    /**
     * The service provider, service operator, or service performer; the goods producer. Another party (a seller) may offer those services or goods on behalf of the provider. A provider may also serve as the seller.
     *
     * @see https://schema.org/provider
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ApiProperty(types: ['https://schema.org/provider'])]
    private ?Person $provider = null;

    /**
     * An entity that arranges for an exchange between a buyer and a seller. In most cases a broker never acquires or releases ownership of a product or service involved in an exchange. If it is not clear whether an entity is a broker, seller, or buyer, the latter two terms are preferred.
     *
     * @see https://schema.org/broker
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/broker'])]
    #[Assert\NotNull]
    private Person $broker;

    /**
     * The currency of the price, or a price component when attached to \[\[PriceSpecification\]\] and its subtypes.\\n\\nUse standard formats: \[ISO 4217 currency format\](http://en.wikipedia.org/wiki/ISO\_4217), e.g. "USD"; \[Ticker symbol\](https://en.wikipedia.org/wiki/List\_of\_cryptocurrencies) for cryptocurrencies, e.g. "BTC"; well known names for \[Local Exchange Trading Systems\](https://en.wikipedia.org/wiki/Local\_exchange\_trading\_system) (LETS) and other currency types, e.g. "Ithaca HOUR".
     *
     * @see https://schema.org/priceCurrency
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/priceCurrency'])]
    #[Assert\NotNull]
    private string $priceCurrency;

    /**
     * The date and time the reservation was modified.
     *
     * @see https://schema.org/modifiedTime
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\DateTime')]
    #[ApiProperty(types: ['https://schema.org/modifiedTime'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $modifiedTime = null;

    /**
     * The thing -- flight, event, restaurant, etc. being reserved.
     *
     * @see https://schema.org/reservationFor
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Thing')]
    #[ApiProperty(types: ['https://schema.org/reservationFor'])]
    private ?Thing $reservationFor = null;

    /**
     * The person or organization the reservation or ticket is for.
     *
     * @see https://schema.org/underName
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
    #[ApiProperty(types: ['https://schema.org/underName'])]
    private ?Organization $underName = null;

    /**
     * The current status of the reservation.
     *
     * @see https://schema.org/reservationStatus
     */
    #[ORM\Column(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/reservationStatus'])]
    #[Assert\Choice(callback: [ReservationStatusType::class, 'toArray'])]
    private ?string $reservationStatus = null;

    /**
     * The total price for the reservation or ticket, including applicable taxes, shipping, etc.\\n\\nUsage guidelines:\\n\\n\* Use values from 0123456789 (Unicode 'DIGIT ZERO' (U+0030) to 'DIGIT NINE' (U+0039)) rather than superficially similar Unicode symbols.\\n\* Use '.' (Unicode 'FULL STOP' (U+002E)) rather than ',' to indicate a decimal point. Avoid using these symbols as a readability separator.
     *
     * @see https://schema.org/totalPrice
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\PriceSpecification')]
    #[ApiProperty(types: ['https://schema.org/totalPrice'])]
    private ?PriceSpecification $totalPrice = null;

    /**
     * The date and time the reservation was booked.
     *
     * @see https://schema.org/bookingTime
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\DateTime')]
    #[ApiProperty(types: ['https://schema.org/bookingTime'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $bookingTime = null;

    /**
     * A ticket associated with the reservation.
     *
     * @see https://schema.org/reservedTicket
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Ticket')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/reservedTicket'])]
    #[Assert\NotNull]
    private Ticket $reservedTicket;

    public function setProgramMembershipUsed(ProgramMembership $programMembershipUsed): void
    {
        $this->programMembershipUsed = $programMembershipUsed;
    }

    public function getProgramMembershipUsed(): ProgramMembership
    {
        return $this->programMembershipUsed;
    }

    public function setReservationId(?string $reservationId): void
    {
        $this->reservationId = $reservationId;
    }

    public function getReservationId(): ?string
    {
        return $this->reservationId;
    }

    public function setProvider(?Person $provider): void
    {
        $this->provider = $provider;
    }

    public function getProvider(): ?Person
    {
        return $this->provider;
    }

    public function setBroker(Person $broker): void
    {
        $this->broker = $broker;
    }

    public function getBroker(): Person
    {
        return $this->broker;
    }

    public function setPriceCurrency(string $priceCurrency): void
    {
        $this->priceCurrency = $priceCurrency;
    }

    public function getPriceCurrency(): string
    {
        return $this->priceCurrency;
    }

    public function setModifiedTime(?\DateTimeInterface $modifiedTime): void
    {
        $this->modifiedTime = $modifiedTime;
    }

    public function getModifiedTime(): ?\DateTimeInterface
    {
        return $this->modifiedTime;
    }

    public function setReservationFor(?Thing $reservationFor): void
    {
        $this->reservationFor = $reservationFor;
    }

    public function getReservationFor(): ?Thing
    {
        return $this->reservationFor;
    }

    public function setUnderName(?Organization $underName): void
    {
        $this->underName = $underName;
    }

    public function getUnderName(): ?Organization
    {
        return $this->underName;
    }

    public function setReservationStatus(?string $reservationStatus): void
    {
        $this->reservationStatus = $reservationStatus;
    }

    public function getReservationStatus(): ?string
    {
        return $this->reservationStatus;
    }

    public function setTotalPrice(?PriceSpecification $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
    }

    public function getTotalPrice(): ?PriceSpecification
    {
        return $this->totalPrice;
    }

    public function setBookingTime(?\DateTimeInterface $bookingTime): void
    {
        $this->bookingTime = $bookingTime;
    }

    public function getBookingTime(): ?\DateTimeInterface
    {
        return $this->bookingTime;
    }

    public function setReservedTicket(Ticket $reservedTicket): void
    {
        $this->reservedTicket = $reservedTicket;
    }

    public function getReservedTicket(): Ticket
    {
        return $this->reservedTicket;
    }
}
