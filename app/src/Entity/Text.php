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
 * Data type: Text.
 *
 * @see https://schema.org/Text
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
	'text' => Text::class,
	'URL' => URL::class,
	'cssSelectorType' => CssSelectorType::class,
	'xPathType' => XPathType::class,
	'pronounceableText' => PronounceableText::class,
])]
class Text
{
	#[ORM\Id]
	#[ORM\GeneratedValue(strategy: 'AUTO')]
	#[ORM\Column(type: 'integer')]
	private ?int $id = null;

	public function getId(): ?int
	{
		return $this->id;
	}
}
