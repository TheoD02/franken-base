<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * \[\[Recommendation\]\] is a type of \[\[Review\]\] that suggests or proposes something as the best option or best course of action. Recommendations may be for products or services, or other concrete things, as in the case of a ranked list or product guide. A \[\[Guide\]\] may list multiple recommendations for different categories. For example, in a \[\[Guide\]\] about which TVs to buy, the author may have several \[\[Recommendation\]\]s.
 *
 * @see https://schema.org/Recommendation
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Recommendation'])]
class Recommendation extends Review
{
    /**
     * @var Collection<Text>|null A category for the item. Greater signs or slashes can be used to informally indicate a category hierarchy.
     *
     * @see https://schema.org/category
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'recommendation_text_category')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/category'])]
    private ?Collection $category = null;

    public function __construct()
    {
        $this->category = new ArrayCollection();
    }

    public function addCategory(string $category): void
    {
        $this->category[] = $category;
    }

    public function removeCategory(string $category): void
    {
        $this->category->removeElement($category);
    }

    /**
     * @return Collection<Text>|null
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }
}
