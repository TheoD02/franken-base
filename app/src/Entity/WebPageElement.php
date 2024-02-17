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
 * A web page element, like a table or an image.
 *
 * @see https://schema.org/WebPageElement
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
	'webPageElement' => WebPageElement::class,
	'siteNavigationElement' => SiteNavigationElement::class,
	'WPAdBlock' => WPAdBlock::class,
	'WPSideBar' => WPSideBar::class,
	'WPHeader' => WPHeader::class,
	'WPFooter' => WPFooter::class,
	'table' => Table::class,
])]
class WebPageElement extends CreativeWork
{
	/**
	 * A CSS selector, e.g. of a \[\[SpeakableSpecification\]\] or \[\[WebPageElement\]\]. In the latter case, multiple matches within a page can constitute a single conceptual "Web page element".
	 *
	 * @see https://schema.org/cssSelector
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\CssSelectorType')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/cssSelector'])]
	#[Assert\NotNull]
	private CssSelectorType $cssSelector;

	/**
	 * An XPath, e.g. of a \[\[SpeakableSpecification\]\] or \[\[WebPageElement\]\]. In the latter case, multiple matches within a page can constitute a single conceptual "Web page element".
	 *
	 * @see https://schema.org/xpath
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\XPathType')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/xpath'])]
	#[Assert\NotNull]
	private XPathType $xpath;

	public function setCssSelector(CssSelectorType $cssSelector): void
	{
		$this->cssSelector = $cssSelector;
	}

	public function getCssSelector(): CssSelectorType
	{
		return $this->cssSelector;
	}

	public function setXpath(XPathType $xpath): void
	{
		$this->xpath = $xpath;
	}

	public function getXpath(): XPathType
	{
		return $this->xpath;
	}
}
