<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Enum\DayOfWeek;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A structured value providing information about the opening hours of a place or a certain service inside a place.\\n\\n The place is \_\_open\_\_ if the \[\[opens\]\] property is specified, and \_\_closed\_\_ otherwise.\\n\\nIf the value for the \[\[closes\]\] property is less than the value for the \[\[opens\]\] property then the hour range is assumed to span over the next day.
 *
 * @see https://schema.org/OpeningHoursSpecification
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/OpeningHoursSpecification'])]
class OpeningHoursSpecification extends StructuredValue
{
    /**
     * @var string[] the day of the week for which these opening hours are valid
     *
     * @see https://schema.org/dayOfWeek
     */
    #[ORM\Column(type: 'simple_array')]
    #[ApiProperty(types: ['https://schema.org/dayOfWeek'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [DayOfWeek::class, 'toArray'], multiple: true)]
    private Collection $dayOfWeek;

    /**
     * The closing hour of the place or service on the given day(s) of the week.
     *
     * @see https://schema.org/closes
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Time')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/closes'])]
    #[Assert\Type(\DateTimeInterface::class)]
    #[Assert\NotNull]
    private \DateTimeInterface $closes;

    /**
     * The date when the item becomes valid.
     *
     * @see https://schema.org/validFrom
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/validFrom'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $validFrom = null;

    /**
     * The date after when the item is not valid. For example the end of an offer, salary period, or a period of opening hours.
     *
     * @see https://schema.org/validThrough
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/validThrough'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $validThrough = null;

    /**
     * The opening hour of the place or service on the given day(s) of the week.
     *
     * @see https://schema.org/opens
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Time')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/opens'])]
    #[Assert\Type(\DateTimeInterface::class)]
    #[Assert\NotNull]
    private \DateTimeInterface $opens;

    public function addDayOfWeek($dayOfWeek): void
    {
        $this->dayOfWeek[] = (string) $dayOfWeek;
    }

    public function removeDayOfWeek(string $dayOfWeek): void
    {
        if (false !== $key = array_search((string) $dayOfWeek, $this->dayOfWeek, true)) {
            unset($this->dayOfWeek[$key]);
        }
    }

    /**
     * @return string[]
     */
    public function getDayOfWeek(): Collection
    {
        return $this->dayOfWeek;
    }

    public function setCloses(\DateTimeInterface $closes): void
    {
        $this->closes = $closes;
    }

    public function getCloses(): \DateTimeInterface
    {
        return $this->closes;
    }

    public function setValidFrom(?\DateTimeInterface $validFrom): void
    {
        $this->validFrom = $validFrom;
    }

    public function getValidFrom(): ?\DateTimeInterface
    {
        return $this->validFrom;
    }

    public function setValidThrough(?\DateTimeInterface $validThrough): void
    {
        $this->validThrough = $validThrough;
    }

    public function getValidThrough(): ?\DateTimeInterface
    {
        return $this->validThrough;
    }

    public function setOpens(\DateTimeInterface $opens): void
    {
        $this->opens = $opens;
    }

    public function getOpens(): \DateTimeInterface
    {
        return $this->opens;
    }
}
