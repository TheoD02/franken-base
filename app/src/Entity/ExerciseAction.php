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
 * The act of participating in exertive activity for the purposes of improving health and fitness.
 *
 * @see https://schema.org/ExerciseAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ExerciseAction'])]
class ExerciseAction extends PlayAction
{
    /**
     * A sub property of location. The final location of the object or the agent after the action.
     *
     * @see https://schema.org/toLocation
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Place')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/toLocation'])]
    #[Assert\NotNull]
    private Place $toLocation;

    /**
     * A sub property of instrument. The diet used in this action.
     *
     * @see https://schema.org/diet
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Diet')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/diet'])]
    #[Assert\NotNull]
    private Diet $diet;

    /**
     * The distance travelled, e.g. exercising or travelling.
     *
     * @see https://schema.org/distance
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Distance')]
    #[ApiProperty(types: ['https://schema.org/distance'])]
    private ?Distance $distance = null;

    /**
     * A sub property of location. The original location of the object or the agent before the action.
     *
     * @see https://schema.org/fromLocation
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Place')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/fromLocation'])]
    #[Assert\NotNull]
    private Place $fromLocation;

    /**
     * A sub property of participant. The sports team that participated on this action.
     *
     * @see https://schema.org/sportsTeam
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\SportsTeam')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/sportsTeam'])]
    #[Assert\NotNull]
    private SportsTeam $sportsTeam;

    /**
     * A sub property of instrument. The exercise plan used on this action.
     *
     * @see https://schema.org/exercisePlan
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\ExercisePlan')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/exercisePlan'])]
    #[Assert\NotNull]
    private ExercisePlan $exercisePlan;

    /**
     * A sub property of instrument. The diet used in this action.
     *
     * @see https://schema.org/exerciseRelatedDiet
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Diet')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/exerciseRelatedDiet'])]
    #[Assert\NotNull]
    private Diet $exerciseRelatedDiet;

    /**
     * A sub property of location. The sports activity location where this action occurred.
     *
     * @see https://schema.org/sportsActivityLocation
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\SportsActivityLocation')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/sportsActivityLocation'])]
    #[Assert\NotNull]
    private SportsActivityLocation $sportsActivityLocation;

    /**
     * @var Collection<Text>|null type(s) of exercise or activity, such as strength training, flexibility training, aerobics, cardiac rehabilitation, etc
     *
     * @see https://schema.org/exerciseType
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'exercise_action_text_exercise_type')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/exerciseType'])]
    private ?Collection $exerciseType = null;

    /**
     * A sub property of location. The course where this action was taken.
     *
     * @see https://schema.org/exerciseCourse
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Place')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/exerciseCourse'])]
    #[Assert\NotNull]
    private Place $exerciseCourse;

    /**
     * A sub property of location. The sports event where this action occurred.
     *
     * @see https://schema.org/sportsEvent
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\SportsEvent')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/sportsEvent'])]
    #[Assert\NotNull]
    private SportsEvent $sportsEvent;

    /**
     * A sub property of participant. The opponent on this action.
     *
     * @see https://schema.org/opponent
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/opponent'])]
    #[Assert\NotNull]
    private Person $opponent;

    public function __construct()
    {
        $this->exerciseType = new ArrayCollection();
    }

    public function setToLocation(Place $toLocation): void
    {
        $this->toLocation = $toLocation;
    }

    public function getToLocation(): Place
    {
        return $this->toLocation;
    }

    public function setDiet(Diet $diet): void
    {
        $this->diet = $diet;
    }

    public function getDiet(): Diet
    {
        return $this->diet;
    }

    public function setDistance(?Distance $distance): void
    {
        $this->distance = $distance;
    }

    public function getDistance(): ?Distance
    {
        return $this->distance;
    }

    public function setFromLocation(Place $fromLocation): void
    {
        $this->fromLocation = $fromLocation;
    }

    public function getFromLocation(): Place
    {
        return $this->fromLocation;
    }

    public function setSportsTeam(SportsTeam $sportsTeam): void
    {
        $this->sportsTeam = $sportsTeam;
    }

    public function getSportsTeam(): SportsTeam
    {
        return $this->sportsTeam;
    }

    public function setExercisePlan(ExercisePlan $exercisePlan): void
    {
        $this->exercisePlan = $exercisePlan;
    }

    public function getExercisePlan(): ExercisePlan
    {
        return $this->exercisePlan;
    }

    public function setExerciseRelatedDiet(Diet $exerciseRelatedDiet): void
    {
        $this->exerciseRelatedDiet = $exerciseRelatedDiet;
    }

    public function getExerciseRelatedDiet(): Diet
    {
        return $this->exerciseRelatedDiet;
    }

    public function setSportsActivityLocation(SportsActivityLocation $sportsActivityLocation): void
    {
        $this->sportsActivityLocation = $sportsActivityLocation;
    }

    public function getSportsActivityLocation(): SportsActivityLocation
    {
        return $this->sportsActivityLocation;
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

    public function setExerciseCourse(Place $exerciseCourse): void
    {
        $this->exerciseCourse = $exerciseCourse;
    }

    public function getExerciseCourse(): Place
    {
        return $this->exerciseCourse;
    }

    public function setSportsEvent(SportsEvent $sportsEvent): void
    {
        $this->sportsEvent = $sportsEvent;
    }

    public function getSportsEvent(): SportsEvent
    {
        return $this->sportsEvent;
    }

    public function setOpponent(Person $opponent): void
    {
        $this->opponent = $opponent;
    }

    public function getOpponent(): Person
    {
        return $this->opponent;
    }
}
