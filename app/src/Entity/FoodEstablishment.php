<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A food-related business.
 *
 * @see https://schema.org/FoodEstablishment
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
    'foodEstablishment' => FoodEstablishment::class,
    'bakery' => Bakery::class,
    'distillery' => Distillery::class,
    'winery' => Winery::class,
    'barOrPub' => BarOrPub::class,
    'cafeOrCoffeeShop' => CafeOrCoffeeShop::class,
    'iceCreamShop' => IceCreamShop::class,
    'restaurant' => Restaurant::class,
    'fastFoodRestaurant' => FastFoodRestaurant::class,
    'brewery' => Brewery::class,
])]
class FoodEstablishment extends LocalBusiness
{
    /**
     * Either the actual menu as a structured representation, as text, or a URL of the menu.
     *
     * @see https://schema.org/hasMenu
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Menu')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/hasMenu'])]
    #[Assert\NotNull]
    private Menu $hasMenu;

    /**
     * An official rating for a lodging business or food establishment, e.g. from national associations or standards bodies. Use the author property to indicate the rating organization, e.g. as an Organization with name such as (e.g. HOTREC, DEHOGA, WHR, or Hotelstars).
     *
     * @see https://schema.org/starRating
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Rating')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/starRating'])]
    #[Assert\NotNull]
    private Rating $starRating;

    /**
     * Indicates whether a FoodEstablishment accepts reservations. Values can be Boolean, an URL at which reservations can be made or (for backwards compatibility) the strings ```Yes``` or ```No```.
     *
     * @see https://schema.org/acceptsReservations
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/acceptsReservations'])]
    private ?string $acceptsReservations = null;

    /**
     * The cuisine of the restaurant.
     *
     * @see https://schema.org/servesCuisine
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/servesCuisine'])]
    private ?string $servesCuisine = null;

    public function setHasMenu(Menu $hasMenu): void
    {
        $this->hasMenu = $hasMenu;
    }

    public function getHasMenu(): Menu
    {
        return $this->hasMenu;
    }

    public function setStarRating(Rating $starRating): void
    {
        $this->starRating = $starRating;
    }

    public function getStarRating(): Rating
    {
        return $this->starRating;
    }

    public function setAcceptsReservations(?string $acceptsReservations): void
    {
        $this->acceptsReservations = $acceptsReservations;
    }

    public function getAcceptsReservations(): ?string
    {
        return $this->acceptsReservations;
    }

    public function setServesCuisine(?string $servesCuisine): void
    {
        $this->servesCuisine = $servesCuisine;
    }

    public function getServesCuisine(): ?string
    {
        return $this->servesCuisine;
    }
}
