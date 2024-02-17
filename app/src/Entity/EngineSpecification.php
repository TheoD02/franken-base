<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Information about the engine of the vehicle. A vehicle can have multiple engines represented by multiple engine specification entities.
 *
 * @see https://schema.org/EngineSpecification
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/EngineSpecification'])]
class EngineSpecification extends StructuredValue
{
    /**
     * @var Collection<QuantitativeValue>|null The volume swept by all of the pistons inside the cylinders of an internal combustion engine in a single movement. \\n\\nTypical unit code(s): CMQ for cubic centimeter, LTR for liters, INQ for cubic inches\\n\* Note 1: You can link to information about how the given value has been determined using the \[\[valueReference\]\] property.\\n\* Note 2: You can use \[\[minValue\]\] and \[\[maxValue\]\] to indicate ranges.
     *
     * @see https://schema.org/engineDisplacement
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinTable(name: 'engine_specification_quantitative_value_engine_displacement')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/engineDisplacement'])]
    private ?Collection $engineDisplacement = null;

    /**
     * The type of engine or engines powering the vehicle.
     *
     * @see https://schema.org/engineType
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/engineType'])]
    private ?string $engineType = null;

    /**
     * @var Collection<QuantitativeValue>|null The torque (turning force) of the vehicle's engine.\\n\\nTypical unit code(s): NU for newton metre (N m), F17 for pound-force per foot, or F48 for pound-force per inch\\n\\n\* Note 1: You can link to information about how the given value has been determined (e.g. reference RPM) using the \[\[valueReference\]\] property.\\n\* Note 2: You can use \[\[minValue\]\] and \[\[maxValue\]\] to indicate ranges.
     *
     * @see https://schema.org/torque
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinTable(name: 'engine_specification_quantitative_value_torque')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/torque'])]
    private ?Collection $torque = null;

    /**
     * @var Collection<QuantitativeValue>|null The power of the vehicle's engine. Typical unit code(s): KWT for kilowatt, BHP for brake horsepower, N12 for metric horsepower (PS, with 1 PS = 735,49875 W)\\n\\n\* Note 1: There are many different ways of measuring an engine's power. For an overview, see \[http://en.wikipedia.org/wiki/Horsepower#Engine\\\_power\\\_test\\\_codes\](http://en.wikipedia.org/wiki/Horsepower#Engine\_power\_test\_codes).\\n\* Note 2: You can link to information about how the given value has been determined using the \[\[valueReference\]\] property.\\n\* Note 3: You can use \[\[minValue\]\] and \[\[maxValue\]\] to indicate ranges.
     *
     * @see https://schema.org/enginePower
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinTable(name: 'engine_specification_quantitative_value_engine_power')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/enginePower'])]
    private ?Collection $enginePower = null;

    /**
     * The type of fuel suitable for the engine or engines of the vehicle. If the vehicle has only one engine, this property can be attached directly to the vehicle.
     *
     * @see https://schema.org/fuelType
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/fuelType'])]
    private ?string $fuelType = null;

    public function __construct()
    {
        $this->engineDisplacement = new ArrayCollection();
        $this->torque = new ArrayCollection();
        $this->enginePower = new ArrayCollection();
    }

    public function addEngineDisplacement(QuantitativeValue $engineDisplacement): void
    {
        $this->engineDisplacement[] = $engineDisplacement;
    }

    public function removeEngineDisplacement(QuantitativeValue $engineDisplacement): void
    {
        $this->engineDisplacement->removeElement($engineDisplacement);
    }

    /**
     * @return Collection<QuantitativeValue>|null
     */
    public function getEngineDisplacement(): Collection
    {
        return $this->engineDisplacement;
    }

    public function setEngineType(?string $engineType): void
    {
        $this->engineType = $engineType;
    }

    public function getEngineType(): ?string
    {
        return $this->engineType;
    }

    public function addTorque(QuantitativeValue $torque): void
    {
        $this->torque[] = $torque;
    }

    public function removeTorque(QuantitativeValue $torque): void
    {
        $this->torque->removeElement($torque);
    }

    /**
     * @return Collection<QuantitativeValue>|null
     */
    public function getTorque(): Collection
    {
        return $this->torque;
    }

    public function addEnginePower(QuantitativeValue $enginePower): void
    {
        $this->enginePower[] = $enginePower;
    }

    public function removeEnginePower(QuantitativeValue $enginePower): void
    {
        $this->enginePower->removeElement($enginePower);
    }

    /**
     * @return Collection<QuantitativeValue>|null
     */
    public function getEnginePower(): Collection
    {
        return $this->enginePower;
    }

    public function setFuelType(?string $fuelType): void
    {
        $this->fuelType = $fuelType;
    }

    public function getFuelType(): ?string
    {
        return $this->fuelType;
    }
}
