<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Enum\RestrictedDiet;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A food or drink item listed in a menu or menu section.
 *
 * @see https://schema.org/MenuItem
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MenuItem'])]
class MenuItem extends Intangible
{
    /**
     * Indicates a dietary restriction or guideline for which this recipe or menu item is suitable, e.g. diabetic, halal etc.
     *
     * @see https://schema.org/suitableForDiet
     */
    #[ORM\Column]
    #[ApiProperty(types: ['https://schema.org/suitableForDiet'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [RestrictedDiet::class, 'toArray'])]
    private string $suitableForDiet;

    /**
     * Nutrition information about the recipe or menu item.
     *
     * @see https://schema.org/nutrition
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\NutritionInformation')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/nutrition'])]
    #[Assert\NotNull]
    private NutritionInformation $nutrition;

    /**
     * @var Collection<MenuItem>|null Additional menu item(s) such as a side dish of salad or side order of fries that can be added to this menu item. Additionally it can be a menu section containing allowed add-on menu items for this menu item.
     *
     * @see https://schema.org/menuAddOn
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\MenuItem')]
    #[ORM\JoinTable(name: 'menu_item_menu_item_menu_add_on')]
    #[ORM\InverseJoinColumn(name: 'menu_add_on_menu_item_id', unique: true)]
    #[ApiProperty(types: ['https://schema.org/menuAddOn'])]
    private ?Collection $menuAddOn = null;

    /**
     * @var Collection<Demand>|null An offer to provide this item—for example, an offer to sell a product, rent the DVD of a movie, perform a service, or give away tickets to an event. Use \[\[businessFunction\]\] to indicate the kind of transaction offered, i.e. sell, lease, etc. This property can also be used to describe a \[\[Demand\]\]. While this property is listed as expected on a number of common types, it can be used in others. In that case, using a second type, such as Product or a subtype of Product, can clarify the nature of the offer.
     *
     * @see https://schema.org/offers
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Demand')]
    #[ORM\JoinTable(name: 'menu_item_demand_offers')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/offers'])]
    private ?Collection $offers = null;

    public function __construct()
    {
        $this->menuAddOn = new ArrayCollection();
        $this->offers = new ArrayCollection();
    }

    public function setSuitableForDiet(string $suitableForDiet): void
    {
        $this->suitableForDiet = $suitableForDiet;
    }

    public function getSuitableForDiet(): string
    {
        return $this->suitableForDiet;
    }

    public function setNutrition(NutritionInformation $nutrition): void
    {
        $this->nutrition = $nutrition;
    }

    public function getNutrition(): NutritionInformation
    {
        return $this->nutrition;
    }

    public function addMenuAddOn(MenuItem $menuAddOn): void
    {
        $this->menuAddOn[] = $menuAddOn;
    }

    public function removeMenuAddOn(MenuItem $menuAddOn): void
    {
        $this->menuAddOn->removeElement($menuAddOn);
    }

    /**
     * @return Collection<MenuItem>|null
     */
    public function getMenuAddOn(): Collection
    {
        return $this->menuAddOn;
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
}
