<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A \[\[RealEstateListing\]\] is a listing that describes one or more real-estate \[\[Offer\]\]s (whose \[\[businessFunction\]\] is typically to lease out, or to sell). The \[\[RealEstateListing\]\] type itself represents the overall listing, as manifested in some \[\[WebPage\]\].
 *
 * @see https://schema.org/RealEstateListing
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/RealEstateListing'])]
#[ORM\AssociationOverrides([
    new ORM\AssociationOverride(
        name: 'speakable',
        joinTable: new ORM\JoinTable(name: 'web_page_url_speakable_real_estate_listing'),
        joinColumns: [new ORM\JoinColumn()],
        inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
    ),
])]
class RealEstateListing extends WebPage
{
    /**
     * Publication date of an online listing.
     *
     * @see https://schema.org/datePosted
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/datePosted'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $datePosted = null;

    /**
     * Length of the lease for some \[\[Accommodation\]\], either particular to some \[\[Offer\]\] or in some cases intrinsic to the property.
     *
     * @see https://schema.org/leaseLength
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/leaseLength'])]
    #[Assert\NotNull]
    private QuantitativeValue $leaseLength;

    public function setDatePosted(?\DateTimeInterface $datePosted): void
    {
        $this->datePosted = $datePosted;
    }

    public function getDatePosted(): ?\DateTimeInterface
    {
        return $this->datePosted;
    }

    public function setLeaseLength(QuantitativeValue $leaseLength): void
    {
        $this->leaseLength = $leaseLength;
    }

    public function getLeaseLength(): QuantitativeValue
    {
        return $this->leaseLength;
    }
}
