<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Web page type: About page.
 *
 * @see https://schema.org/AboutPage
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/AboutPage'])]
#[ORM\AssociationOverrides([
	new ORM\AssociationOverride(
		name: 'speakable',
		joinTable: new ORM\JoinTable(name: 'web_page_url_speakable_about_page'),
		joinColumns: [new ORM\JoinColumn()],
		inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
	),
])]
class AboutPage extends WebPage
{
}
