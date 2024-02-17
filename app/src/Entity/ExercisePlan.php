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
 * Fitness-related activity designed for a specific health-related purpose, including defined exercise routines as well as activity prescribed by a clinician.
 *
 * @see https://schema.org/ExercisePlan
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ExercisePlan'])]
class ExercisePlan extends CreativeWork
{
    /**
     * How often one should break from the activity.
     *
     * @see https://schema.org/restPeriods
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/restPeriods'])]
    #[Assert\NotNull]
    private QuantitativeValue $restPeriods;

    /**
     * Number of times one should repeat the activity.
     *
     * @see https://schema.org/repetitions
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/repetitions'])]
    private ?string $repetitions = null;

    /**
     * How often one should engage in the activity.
     *
     * @see https://schema.org/activityFrequency
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/activityFrequency'])]
    private ?string $activityFrequency = null;

    /**
     * @var Collection<Text>|null type(s) of exercise or activity, such as strength training, flexibility training, aerobics, cardiac rehabilitation, etc
     *
     * @see https://schema.org/exerciseType
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'exercise_plan_text_exercise_type')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/exerciseType'])]
    private ?Collection $exerciseType = null;

    /**
     * Quantitative measure of the physiologic output of the exercise; also referred to as energy expenditure.
     *
     * @see https://schema.org/workload
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Energy')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/workload'])]
    #[Assert\NotNull]
    private Energy $workload;

    /**
     * Quantitative measure gauging the degree of force involved in the exercise, for example, heartbeats per minute. May include the velocity of the movement.
     *
     * @see https://schema.org/intensity
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/intensity'])]
    #[Assert\NotNull]
    private QuantitativeValue $intensity;

    /**
     * Any additional component of the exercise prescription that may need to be articulated to the patient. This may include the order of exercises, the number of repetitions of movement, quantitative distance, progressions over time, etc.
     *
     * @see https://schema.org/additionalVariable
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/additionalVariable'])]
    private ?string $additionalVariable = null;

    /**
     * Length of time to engage in the activity.
     *
     * @see https://schema.org/activityDuration
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/activityDuration'])]
    #[Assert\NotNull]
    private QuantitativeValue $activityDuration;

    public function __construct()
    {
        parent::__construct();
        $this->exerciseType = new ArrayCollection();
    }

    public function setRestPeriods(QuantitativeValue $restPeriods): void
    {
        $this->restPeriods = $restPeriods;
    }

    public function getRestPeriods(): QuantitativeValue
    {
        return $this->restPeriods;
    }

    public function setRepetitions(?string $repetitions): void
    {
        $this->repetitions = $repetitions;
    }

    public function getRepetitions(): ?string
    {
        return $this->repetitions;
    }

    public function setActivityFrequency(?string $activityFrequency): void
    {
        $this->activityFrequency = $activityFrequency;
    }

    public function getActivityFrequency(): ?string
    {
        return $this->activityFrequency;
    }

    public function addExerciseType(string $exerciseType): void
    {
        $this->exerciseType[] = $exerciseType;
    }

    public function removeExerciseType(string $exerciseType): void
    {
        $this->exerciseType->removeElement($exerciseType);
    }

    /**
     * @return Collection<Text>|null
     */
    public function getExerciseType(): Collection
    {
        return $this->exerciseType;
    }

    public function setWorkload(Energy $workload): void
    {
        $this->workload = $workload;
    }

    public function getWorkload(): Energy
    {
        return $this->workload;
    }

    public function setIntensity(QuantitativeValue $intensity): void
    {
        $this->intensity = $intensity;
    }

    public function getIntensity(): QuantitativeValue
    {
        return $this->intensity;
    }

    public function setAdditionalVariable(?string $additionalVariable): void
    {
        $this->additionalVariable = $additionalVariable;
    }

    public function getAdditionalVariable(): ?string
    {
        return $this->additionalVariable;
    }

    public function setActivityDuration(QuantitativeValue $activityDuration): void
    {
        $this->activityDuration = $activityDuration;
    }

    public function getActivityDuration(): QuantitativeValue
    {
        return $this->activityDuration;
    }
}
