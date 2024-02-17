<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\Put;
use App\Enum\CarUsageType;
use App\Enum\DriveWheelConfigurationValue;
use App\Enum\QualitativeValue;
use App\Enum\SteeringPositionValue;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A vehicle is a device that is designed or used to transport people or cargo over land, water, air, or through space.
 *
 * @see https://schema.org/Vehicle
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
    'vehicle' => Vehicle::class,
    'motorizedBicycle' => MotorizedBicycle::class,
    'motorcycle' => Motorcycle::class,
    'busOrCoach' => BusOrCoach::class,
    'car' => Car::class,
])]
class Vehicle extends Product
{
    /**
     * A short text indicating the configuration of the vehicle, e.g. '5dr hatchback ST 2.5 MT 225 hp' or 'limited edition'.
     *
     * @see https://schema.org/vehicleConfiguration
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/vehicleConfiguration'])]
    private ?string $vehicleConfiguration = null;

    /**
     * Indicates the design and body style of the vehicle (e.g. station wagon, hatchback, etc.).
     *
     * @see https://schema.org/bodyType
     */
    #[ORM\Column]
    #[ApiProperty(types: ['https://schema.org/bodyType'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [QualitativeValue::class, 'toArray'])]
    private string $bodyType;

    /**
     * Indicates whether the vehicle has been used for special purposes, like commercial rental, driving school, or as a taxi. The legislation in many countries requires this information to be revealed when offering a car for sale.
     *
     * @see https://schema.org/vehicleSpecialUsage
     */
    #[ORM\Column]
    #[ApiProperty(types: ['https://schema.org/vehicleSpecialUsage'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [CarUsageType::class, 'toArray'])]
    private string $vehicleSpecialUsage;

    /**
     * The color or color combination of the interior of the vehicle.
     *
     * @see https://schema.org/vehicleInteriorColor
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/vehicleInteriorColor'])]
    private ?string $vehicleInteriorColor = null;

    /**
     * @var Collection<QuantitativeValue>|null The time needed to accelerate the vehicle from a given start velocity to a given target velocity.\\n\\nTypical unit code(s): SEC for seconds\\n\\n\* Note: There are unfortunately no standard unit codes for seconds/0..100 km/h or seconds/0..60 mph. Simply use "SEC" for seconds and indicate the velocities in the \[\[name\]\] of the \[\[QuantitativeValue\]\], or use \[\[valueReference\]\] with a \[\[QuantitativeValue\]\] of 0..60 mph or 0..100 km/h to specify the reference speeds.
     *
     * @see https://schema.org/accelerationTime
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinTable(name: 'vehicle_quantitative_value_acceleration_time')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/accelerationTime'])]
    private ?Collection $accelerationTime = null;

    /**
     * @var Collection<QuantitativeValue>|null The permitted weight of a trailer attached to the vehicle.\\n\\nTypical unit code(s): KGM for kilogram, LBR for pound\\n\* Note 1: You can indicate additional information in the \[\[name\]\] of the \[\[QuantitativeValue\]\] node.\\n\* Note 2: You may also link to a \[\[QualitativeValue\]\] node that provides additional information using \[\[valueReference\]\].\\n\* Note 3: Note that you can use \[\[minValue\]\] and \[\[maxValue\]\] to indicate ranges.
     *
     * @see https://schema.org/trailerWeight
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinTable(name: 'vehicle_quantitative_value_trailer_weight')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/trailerWeight'])]
    private ?Collection $trailerWeight = null;

    /**
     * @var Collection<QuantitativeValue>|null The number of axles.\\n\\nTypical unit code(s): C62.
     *
     * @see https://schema.org/numberOfAxles
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinTable(name: 'vehicle_quantitative_value_number_of_axles')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/numberOfAxles'])]
    private ?Collection $numberOfAxles = null;

    /**
     * @var Collection<Number>|null The number of passengers that can be seated in the vehicle, both in terms of the physical space available, and in terms of limitations set by law.\\n\\nTypical unit code(s): C62 for persons.
     *
     * @see https://schema.org/vehicleSeatingCapacity
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Number')]
    #[ORM\JoinTable(name: 'vehicle_number_vehicle_seating_capacity')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/vehicleSeatingCapacity'])]
    private ?Collection $vehicleSeatingCapacity = null;

    /**
     * The drive wheel configuration, i.e. which roadwheels will receive torque from the vehicle's engine via the drivetrain.
     *
     * @see https://schema.org/driveWheelConfiguration
     */
    #[ORM\Column(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/driveWheelConfiguration'])]
    #[Assert\Choice(callback: [DriveWheelConfigurationValue::class, 'toArray'])]
    private ?string $driveWheelConfiguration = null;

    /**
     * @var Collection<QuantitativeValue>|null The permitted vertical load (TWR) of a trailer attached to the vehicle. Also referred to as Tongue Load Rating (TLR) or Vertical Load Rating (VLR).\\n\\nTypical unit code(s): KGM for kilogram, LBR for pound\\n\\n\* Note 1: You can indicate additional information in the \[\[name\]\] of the \[\[QuantitativeValue\]\] node.\\n\* Note 2: You may also link to a \[\[QualitativeValue\]\] node that provides additional information using \[\[valueReference\]\].\\n\* Note 3: Note that you can use \[\[minValue\]\] and \[\[maxValue\]\] to indicate ranges.
     *
     * @see https://schema.org/tongueWeight
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinTable(name: 'vehicle_quantitative_value_tongue_weight')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/tongueWeight'])]
    private ?Collection $tongueWeight = null;

    /**
     * The Vehicle Identification Number (VIN) is a unique serial number used by the automotive industry to identify individual motor vehicles.
     *
     * @see https://schema.org/vehicleIdentificationNumber
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/vehicleIdentificationNumber'])]
    private ?string $vehicleIdentificationNumber = null;

    /**
     * The type or material of the interior of the vehicle (e.g. synthetic fabric, leather, wood, etc.). While most interior types are characterized by the material used, an interior type can also be based on vehicle usage or target audience.
     *
     * @see https://schema.org/vehicleInteriorType
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/vehicleInteriorType'])]
    private ?string $vehicleInteriorType = null;

    /**
     * @var Collection<Text>|null the type of component used for transmitting the power from a rotating power source to the wheels or other relevant component(s) ("gearbox" for cars)
     *
     * @see https://schema.org/vehicleTransmission
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'vehicle_text_vehicle_transmission')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/vehicleTransmission'])]
    private ?Collection $vehicleTransmission = null;

    /**
     * @var Collection<QuantitativeValue>|null The total distance travelled by the particular vehicle since its initial production, as read from its odometer.\\n\\nTypical unit code(s): KMT for kilometers, SMI for statute miles.
     *
     * @see https://schema.org/mileageFromOdometer
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinTable(name: 'vehicle_quantitative_value_mileage_from_odometer')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/mileageFromOdometer'])]
    private ?Collection $mileageFromOdometer = null;

    /**
     * @var Collection<Number>|null The number of doors.\\n\\nTypical unit code(s): C62.
     *
     * @see https://schema.org/numberOfDoors
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Number')]
    #[ORM\JoinTable(name: 'vehicle_number_number_of_doors')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/numberOfDoors'])]
    private ?Collection $numberOfDoors = null;

    /**
     * A \[callsign\](https://en.wikipedia.org/wiki/Call\_sign), as used in broadcasting and radio communications to identify people, radio and TV stations, or vehicles.
     *
     * @see https://schema.org/callSign
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/callSign'])]
    private ?string $callSign = null;

    /**
     * @var Collection<Number>|null The total number of forward gears available for the transmission system of the vehicle.\\n\\nTypical unit code(s): C62.
     *
     * @see https://schema.org/numberOfForwardGears
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Number')]
    #[ORM\JoinTable(name: 'vehicle_number_number_of_forward_gears')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/numberOfForwardGears'])]
    private ?Collection $numberOfForwardGears = null;

    /**
     * Information about the engine or engines of the vehicle.
     *
     * @see https://schema.org/vehicleEngine
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\EngineSpecification')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/vehicleEngine'])]
    #[Assert\NotNull]
    private EngineSpecification $vehicleEngine;

    /**
     * Indicates that the vehicle meets the respective emission standard.
     *
     * @see https://schema.org/meetsEmissionStandard
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/meetsEmissionStandard'])]
    private ?string $meetsEmissionStandard = null;

    /**
     * @var Collection<QuantitativeValue>|null The permitted weight of passengers and cargo, EXCLUDING the weight of the empty vehicle.\\n\\nTypical unit code(s): KGM for kilogram, LBR for pound\\n\\n\* Note 1: Many databases specify the permitted TOTAL weight instead, which is the sum of \[\[weight\]\] and \[\[payload\]\]\\n\* Note 2: You can indicate additional information in the \[\[name\]\] of the \[\[QuantitativeValue\]\] node.\\n\* Note 3: You may also link to a \[\[QualitativeValue\]\] node that provides additional information using \[\[valueReference\]\].\\n\* Note 4: Note that you can use \[\[minValue\]\] and \[\[maxValue\]\] to indicate ranges.
     *
     * @see https://schema.org/payload
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinTable(name: 'vehicle_quantitative_value_payload')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/payload'])]
    private ?Collection $payload = null;

    /**
     * The position of the steering wheel or similar device (mostly for cars).
     *
     * @see https://schema.org/steeringPosition
     */
    #[ORM\Column(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/steeringPosition'])]
    #[Assert\Choice(callback: [SteeringPositionValue::class, 'toArray'])]
    private ?string $steeringPosition = null;

    /**
     * The release date of a vehicle model (often used to differentiate versions of the same make and model).
     *
     * @see https://schema.org/modelDate
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/modelDate'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $modelDate = null;

    /**
     * The type of fuel suitable for the engine or engines of the vehicle. If the vehicle has only one engine, this property can be attached directly to the vehicle.
     *
     * @see https://schema.org/fuelType
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/fuelType'])]
    private ?string $fuelType = null;

    /**
     * @var Collection<QuantitativeValue>|null The permitted total weight of the loaded vehicle, including passengers and cargo and the weight of the empty vehicle.\\n\\nTypical unit code(s): KGM for kilogram, LBR for pound\\n\\n\* Note 1: You can indicate additional information in the \[\[name\]\] of the \[\[QuantitativeValue\]\] node.\\n\* Note 2: You may also link to a \[\[QualitativeValue\]\] node that provides additional information using \[\[valueReference\]\].\\n\* Note 3: Note that you can use \[\[minValue\]\] and \[\[maxValue\]\] to indicate ranges.
     *
     * @see https://schema.org/weightTotal
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinTable(name: 'vehicle_quantitative_value_weight_total')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/weightTotal'])]
    private ?Collection $weightTotal = null;

    /**
     * @var Collection<QuantitativeValue>|null The speed range of the vehicle. If the vehicle is powered by an engine, the upper limit of the speed range (indicated by \[\[maxValue\]\]) should be the maximum speed achievable under regular conditions.\\n\\nTypical unit code(s): KMH for km/h, HM for mile per hour (0.447 04 m/s), KNT for knot\\n\\n\*Note 1: Use \[\[minValue\]\] and \[\[maxValue\]\] to indicate the range. Typically, the minimal value is zero.\\n\* Note 2: There are many different ways of measuring the speed range. You can link to information about how the given value has been determined using the \[\[valueReference\]\] property.
     *
     * @see https://schema.org/speed
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinTable(name: 'vehicle_quantitative_value_speed')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/speed'])]
    private ?Collection $speed = null;

    /**
     * The distance traveled per unit of fuel used; most commonly miles per gallon (mpg) or kilometers per liter (km/L).\\n\\n\* Note 1: There are unfortunately no standard unit codes for miles per gallon or kilometers per liter. Use \[\[unitText\]\] to indicate the unit of measurement, e.g. mpg or km/L.\\n\* Note 2: There are two ways of indicating the fuel consumption, \[\[fuelConsumption\]\] (e.g. 8 liters per 100 km) and \[\[fuelEfficiency\]\] (e.g. 30 miles per gallon). They are reciprocal.\\n\* Note 3: Often, the absolute value is useful only when related to driving speed ("at 80 km/h") or usage pattern ("city traffic"). You can use \[\[valueReference\]\] to link the value for the fuel economy to another value.
     *
     * @see https://schema.org/fuelEfficiency
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ApiProperty(types: ['https://schema.org/fuelEfficiency'])]
    private ?QuantitativeValue $fuelEfficiency = null;

    /**
     * The date of the first registration of the vehicle with the respective public authorities.
     *
     * @see https://schema.org/dateVehicleFirstRegistered
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/dateVehicleFirstRegistered'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $dateVehicleFirstRegistered = null;

    /**
     * @var Collection<QuantitativeValue>|null The distance between the centers of the front and rear wheels.\\n\\nTypical unit code(s): CMT for centimeters, MTR for meters, INH for inches, FOT for foot/feet.
     *
     * @see https://schema.org/wheelbase
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinTable(name: 'vehicle_quantitative_value_wheelbase')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/wheelbase'])]
    private ?Collection $wheelbase = null;

    /**
     * @var Collection<Number>|null The number of owners of the vehicle, including the current one.\\n\\nTypical unit code(s): C62.
     *
     * @see https://schema.org/numberOfPreviousOwners
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Number')]
    #[ORM\JoinTable(name: 'vehicle_number_number_of_previous_owners')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/numberOfPreviousOwners'])]
    private ?Collection $numberOfPreviousOwners = null;

    /**
     * @var Collection<QuantitativeValue>|null The capacity of the fuel tank or in the case of electric cars, the battery. If there are multiple components for storage, this should indicate the total of all storage of the same type.\\n\\nTypical unit code(s): LTR for liters, GLL of US gallons, GLI for UK / imperial gallons, AMH for ampere-hours (for electrical vehicles).
     *
     * @see https://schema.org/fuelCapacity
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinTable(name: 'vehicle_quantitative_value_fuel_capacity')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/fuelCapacity'])]
    private ?Collection $fuelCapacity = null;

    /**
     * The number or type of airbags in the vehicle.
     *
     * @see https://schema.org/numberOfAirbags
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/numberOfAirbags'])]
    private ?string $numberOfAirbags = null;

    /**
     * A textual description of known damages, both repaired and unrepaired.
     *
     * @see https://schema.org/knownVehicleDamages
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/knownVehicleDamages'])]
    private ?string $knownVehicleDamages = null;

    /**
     * The amount of fuel consumed for traveling a particular distance or temporal duration with the given vehicle (e.g. liters per 100 km).\\n\\n\* Note 1: There are unfortunately no standard unit codes for liters per 100 km. Use \[\[unitText\]\] to indicate the unit of measurement, e.g. L/100 km.\\n\* Note 2: There are two ways of indicating the fuel consumption, \[\[fuelConsumption\]\] (e.g. 8 liters per 100 km) and \[\[fuelEfficiency\]\] (e.g. 30 miles per gallon). They are reciprocal.\\n\* Note 3: Often, the absolute value is useful only when related to driving speed ("at 80 km/h") or usage pattern ("city traffic"). You can use \[\[valueReference\]\] to link the value for the fuel consumption to another value.
     *
     * @see https://schema.org/fuelConsumption
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ApiProperty(types: ['https://schema.org/fuelConsumption'])]
    private ?QuantitativeValue $fuelConsumption = null;

    /**
     * @var Collection<QuantitativeValue>|null The number of persons that can be seated (e.g. in a vehicle), both in terms of the physical space available, and in terms of limitations set by law.\\n\\nTypical unit code(s): C62 for persons.
     *
     * @see https://schema.org/seatingCapacity
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinTable(name: 'vehicle_quantitative_value_seating_capacity')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/seatingCapacity'])]
    private ?Collection $seatingCapacity = null;

    /**
     * The CO2 emissions in g/km. When used in combination with a QuantitativeValue, put "g/km" into the unitText property of that value, since there is no UN/CEFACT Common Code for "g/km".
     *
     * @see https://schema.org/emissionsCO2
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/emissionsCO2'])]
    private ?string $emissionsCO2 = null;

    /**
     * The release date of a vehicle model (often used to differentiate versions of the same make and model).
     *
     * @see https://schema.org/vehicleModelDate
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/vehicleModelDate'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $vehicleModelDate = null;

    /**
     * @var Collection<QuantitativeValue>|null The available volume for cargo or luggage. For automobiles, this is usually the trunk volume.\\n\\nTypical unit code(s): LTR for liters, FTQ for cubic foot/feet\\n\\nNote: You can use \[\[minValue\]\] and \[\[maxValue\]\] to indicate ranges.
     *
     * @see https://schema.org/cargoVolume
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinTable(name: 'vehicle_quantitative_value_cargo_volume')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/cargoVolume'])]
    private ?Collection $cargoVolume = null;

    public function __construct()
    {
        parent::__construct();
        $this->accelerationTime = new ArrayCollection();
        $this->trailerWeight = new ArrayCollection();
        $this->numberOfAxles = new ArrayCollection();
        $this->vehicleSeatingCapacity = new ArrayCollection();
        $this->tongueWeight = new ArrayCollection();
        $this->vehicleTransmission = new ArrayCollection();
        $this->mileageFromOdometer = new ArrayCollection();
        $this->numberOfDoors = new ArrayCollection();
        $this->numberOfForwardGears = new ArrayCollection();
        $this->payload = new ArrayCollection();
        $this->weightTotal = new ArrayCollection();
        $this->speed = new ArrayCollection();
        $this->wheelbase = new ArrayCollection();
        $this->numberOfPreviousOwners = new ArrayCollection();
        $this->fuelCapacity = new ArrayCollection();
        $this->seatingCapacity = new ArrayCollection();
        $this->cargoVolume = new ArrayCollection();
    }

    public function setVehicleConfiguration(?string $vehicleConfiguration): void
    {
        $this->vehicleConfiguration = $vehicleConfiguration;
    }

    public function getVehicleConfiguration(): ?string
    {
        return $this->vehicleConfiguration;
    }

    public function setBodyType(string $bodyType): void
    {
        $this->bodyType = $bodyType;
    }

    public function getBodyType(): string
    {
        return $this->bodyType;
    }

    public function setVehicleSpecialUsage(string $vehicleSpecialUsage): void
    {
        $this->vehicleSpecialUsage = $vehicleSpecialUsage;
    }

    public function getVehicleSpecialUsage(): string
    {
        return $this->vehicleSpecialUsage;
    }

    public function setVehicleInteriorColor(?string $vehicleInteriorColor): void
    {
        $this->vehicleInteriorColor = $vehicleInteriorColor;
    }

    public function getVehicleInteriorColor(): ?string
    {
        return $this->vehicleInteriorColor;
    }

    public function addAccelerationTime(QuantitativeValue $accelerationTime): void
    {
        $this->accelerationTime[] = $accelerationTime;
    }

    public function removeAccelerationTime(QuantitativeValue $accelerationTime): void
    {
        $this->accelerationTime->removeElement($accelerationTime);
    }

    /**
     * @return Collection<QuantitativeValue>|null
     */
    public function getAccelerationTime(): Collection
    {
        return $this->accelerationTime;
    }

    public function addTrailerWeight(QuantitativeValue $trailerWeight): void
    {
        $this->trailerWeight[] = $trailerWeight;
    }

    public function removeTrailerWeight(QuantitativeValue $trailerWeight): void
    {
        $this->trailerWeight->removeElement($trailerWeight);
    }

    /**
     * @return Collection<QuantitativeValue>|null
     */
    public function getTrailerWeight(): Collection
    {
        return $this->trailerWeight;
    }

    public function addNumberOfAxl(QuantitativeValue $numberOfAxl): void
    {
        $this->numberOfAxles[] = $numberOfAxl;
    }

    public function removeNumberOfAxl(QuantitativeValue $numberOfAxl): void
    {
        $this->numberOfAxles->removeElement($numberOfAxl);
    }

    /**
     * @return Collection<QuantitativeValue>|null
     */
    public function getNumberOfAxles(): Collection
    {
        return $this->numberOfAxles;
    }

    public function addVehicleSeatingCapacity(string $vehicleSeatingCapacity): void
    {
        $this->vehicleSeatingCapacity[] = $vehicleSeatingCapacity;
    }

    public function removeVehicleSeatingCapacity(string $vehicleSeatingCapacity): void
    {
        $this->vehicleSeatingCapacity->removeElement($vehicleSeatingCapacity);
    }

    /**
     * @return Collection<Number>|null
     */
    public function getVehicleSeatingCapacity(): Collection
    {
        return $this->vehicleSeatingCapacity;
    }

    public function setDriveWheelConfiguration(?string $driveWheelConfiguration): void
    {
        $this->driveWheelConfiguration = $driveWheelConfiguration;
    }

    public function getDriveWheelConfiguration(): ?string
    {
        return $this->driveWheelConfiguration;
    }

    public function addTongueWeight(QuantitativeValue $tongueWeight): void
    {
        $this->tongueWeight[] = $tongueWeight;
    }

    public function removeTongueWeight(QuantitativeValue $tongueWeight): void
    {
        $this->tongueWeight->removeElement($tongueWeight);
    }

    /**
     * @return Collection<QuantitativeValue>|null
     */
    public function getTongueWeight(): Collection
    {
        return $this->tongueWeight;
    }

    public function setVehicleIdentificationNumber(?string $vehicleIdentificationNumber): void
    {
        $this->vehicleIdentificationNumber = $vehicleIdentificationNumber;
    }

    public function getVehicleIdentificationNumber(): ?string
    {
        return $this->vehicleIdentificationNumber;
    }

    public function setVehicleInteriorType(?string $vehicleInteriorType): void
    {
        $this->vehicleInteriorType = $vehicleInteriorType;
    }

    public function getVehicleInteriorType(): ?string
    {
        return $this->vehicleInteriorType;
    }

    public function addVehicleTransmission(string $vehicleTransmission): void
    {
        $this->vehicleTransmission[] = $vehicleTransmission;
    }

    public function removeVehicleTransmission(string $vehicleTransmission): void
    {
        $this->vehicleTransmission->removeElement($vehicleTransmission);
    }

    /**
     * @return Collection<Text>|null
     */
    public function getVehicleTransmission(): Collection
    {
        return $this->vehicleTransmission;
    }

    public function addMileageFromOdometer(QuantitativeValue $mileageFromOdometer): void
    {
        $this->mileageFromOdometer[] = $mileageFromOdometer;
    }

    public function removeMileageFromOdometer(QuantitativeValue $mileageFromOdometer): void
    {
        $this->mileageFromOdometer->removeElement($mileageFromOdometer);
    }

    /**
     * @return Collection<QuantitativeValue>|null
     */
    public function getMileageFromOdometer(): Collection
    {
        return $this->mileageFromOdometer;
    }

    public function addNumberOfDoor(string $numberOfDoor): void
    {
        $this->numberOfDoors[] = $numberOfDoor;
    }

    public function removeNumberOfDoor(string $numberOfDoor): void
    {
        $this->numberOfDoors->removeElement($numberOfDoor);
    }

    /**
     * @return Collection<Number>|null
     */
    public function getNumberOfDoors(): Collection
    {
        return $this->numberOfDoors;
    }

    public function setCallSign(?string $callSign): void
    {
        $this->callSign = $callSign;
    }

    public function getCallSign(): ?string
    {
        return $this->callSign;
    }

    public function addNumberOfForwardGear(string $numberOfForwardGear): void
    {
        $this->numberOfForwardGears[] = $numberOfForwardGear;
    }

    public function removeNumberOfForwardGear(string $numberOfForwardGear): void
    {
        $this->numberOfForwardGears->removeElement($numberOfForwardGear);
    }

    /**
     * @return Collection<Number>|null
     */
    public function getNumberOfForwardGears(): Collection
    {
        return $this->numberOfForwardGears;
    }

    public function setVehicleEngine(EngineSpecification $vehicleEngine): void
    {
        $this->vehicleEngine = $vehicleEngine;
    }

    public function getVehicleEngine(): EngineSpecification
    {
        return $this->vehicleEngine;
    }

    public function setMeetsEmissionStandard(?string $meetsEmissionStandard): void
    {
        $this->meetsEmissionStandard = $meetsEmissionStandard;
    }

    public function getMeetsEmissionStandard(): ?string
    {
        return $this->meetsEmissionStandard;
    }

    public function addPayload(QuantitativeValue $payload): void
    {
        $this->payload[] = $payload;
    }

    public function removePayload(QuantitativeValue $payload): void
    {
        $this->payload->removeElement($payload);
    }

    /**
     * @return Collection<QuantitativeValue>|null
     */
    public function getPayload(): Collection
    {
        return $this->payload;
    }

    public function setSteeringPosition(?string $steeringPosition): void
    {
        $this->steeringPosition = $steeringPosition;
    }

    public function getSteeringPosition(): ?string
    {
        return $this->steeringPosition;
    }

    public function setModelDate(?\DateTimeInterface $modelDate): void
    {
        $this->modelDate = $modelDate;
    }

    public function getModelDate(): ?\DateTimeInterface
    {
        return $this->modelDate;
    }

    public function setFuelType(?string $fuelType): void
    {
        $this->fuelType = $fuelType;
    }

    public function getFuelType(): ?string
    {
        return $this->fuelType;
    }

    public function addWeightTotal(QuantitativeValue $weightTotal): void
    {
        $this->weightTotal[] = $weightTotal;
    }

    public function removeWeightTotal(QuantitativeValue $weightTotal): void
    {
        $this->weightTotal->removeElement($weightTotal);
    }

    /**
     * @return Collection<QuantitativeValue>|null
     */
    public function getWeightTotal(): Collection
    {
        return $this->weightTotal;
    }

    public function addSpeed(QuantitativeValue $speed): void
    {
        $this->speed[] = $speed;
    }

    public function removeSpeed(QuantitativeValue $speed): void
    {
        $this->speed->removeElement($speed);
    }

    /**
     * @return Collection<QuantitativeValue>|null
     */
    public function getSpeed(): Collection
    {
        return $this->speed;
    }

    public function setFuelEfficiency(?QuantitativeValue $fuelEfficiency): void
    {
        $this->fuelEfficiency = $fuelEfficiency;
    }

    public function getFuelEfficiency(): ?QuantitativeValue
    {
        return $this->fuelEfficiency;
    }

    public function setDateVehicleFirstRegistered(?\DateTimeInterface $dateVehicleFirstRegistered): void
    {
        $this->dateVehicleFirstRegistered = $dateVehicleFirstRegistered;
    }

    public function getDateVehicleFirstRegistered(): ?\DateTimeInterface
    {
        return $this->dateVehicleFirstRegistered;
    }

    public function addWheelbase(QuantitativeValue $wheelbase): void
    {
        $this->wheelbase[] = $wheelbase;
    }

    public function removeWheelbase(QuantitativeValue $wheelbase): void
    {
        $this->wheelbase->removeElement($wheelbase);
    }

    /**
     * @return Collection<QuantitativeValue>|null
     */
    public function getWheelbase(): Collection
    {
        return $this->wheelbase;
    }

    public function addNumberOfPreviousOwner(string $numberOfPreviousOwner): void
    {
        $this->numberOfPreviousOwners[] = $numberOfPreviousOwner;
    }

    public function removeNumberOfPreviousOwner(string $numberOfPreviousOwner): void
    {
        $this->numberOfPreviousOwners->removeElement($numberOfPreviousOwner);
    }

    /**
     * @return Collection<Number>|null
     */
    public function getNumberOfPreviousOwners(): Collection
    {
        return $this->numberOfPreviousOwners;
    }

    public function addFuelCapacity(QuantitativeValue $fuelCapacity): void
    {
        $this->fuelCapacity[] = $fuelCapacity;
    }

    public function removeFuelCapacity(QuantitativeValue $fuelCapacity): void
    {
        $this->fuelCapacity->removeElement($fuelCapacity);
    }

    /**
     * @return Collection<QuantitativeValue>|null
     */
    public function getFuelCapacity(): Collection
    {
        return $this->fuelCapacity;
    }

    public function setNumberOfAirbags(?string $numberOfAirbags): void
    {
        $this->numberOfAirbags = $numberOfAirbags;
    }

    public function getNumberOfAirbags(): ?string
    {
        return $this->numberOfAirbags;
    }

    public function setKnownVehicleDamages(?string $knownVehicleDamages): void
    {
        $this->knownVehicleDamages = $knownVehicleDamages;
    }

    public function getKnownVehicleDamages(): ?string
    {
        return $this->knownVehicleDamages;
    }

    public function setFuelConsumption(?QuantitativeValue $fuelConsumption): void
    {
        $this->fuelConsumption = $fuelConsumption;
    }

    public function getFuelConsumption(): ?QuantitativeValue
    {
        return $this->fuelConsumption;
    }

    public function addSeatingCapacity(QuantitativeValue $seatingCapacity): void
    {
        $this->seatingCapacity[] = $seatingCapacity;
    }

    public function removeSeatingCapacity(QuantitativeValue $seatingCapacity): void
    {
        $this->seatingCapacity->removeElement($seatingCapacity);
    }

    /**
     * @return Collection<QuantitativeValue>|null
     */
    public function getSeatingCapacity(): Collection
    {
        return $this->seatingCapacity;
    }

    public function setEmissionsCO2(?string $emissionsCO2): void
    {
        $this->emissionsCO2 = $emissionsCO2;
    }

    public function getEmissionsCO2(): ?string
    {
        return $this->emissionsCO2;
    }

    public function setVehicleModelDate(?\DateTimeInterface $vehicleModelDate): void
    {
        $this->vehicleModelDate = $vehicleModelDate;
    }

    public function getVehicleModelDate(): ?\DateTimeInterface
    {
        return $this->vehicleModelDate;
    }

    public function addCargoVolume(QuantitativeValue $cargoVolume): void
    {
        $this->cargoVolume[] = $cargoVolume;
    }

    public function removeCargoVolume(QuantitativeValue $cargoVolume): void
    {
        $this->cargoVolume->removeElement($cargoVolume);
    }

    /**
     * @return Collection<QuantitativeValue>|null
     */
    public function getCargoVolume(): Collection
    {
        return $this->cargoVolume;
    }
}
