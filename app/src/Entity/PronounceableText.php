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
 * Data type: PronounceableText.
 *
 * @see https://schema.org/PronounceableText
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PronounceableText'])]
class PronounceableText extends Text
{
	/**
	 * The language of the content or performance or used in an action. Please use one of the language codes from the \[IETF BCP 47 standard\](http://tools.ietf.org/html/bcp47). See also \[\[availableLanguage\]\].
	 *
	 * @see https://schema.org/inLanguage
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/inLanguage'])]
	private ?string $inLanguage = null;

	/**
	 * Representation of a text \[\[textValue\]\] using the specified \[\[speechToTextMarkup\]\]. For example the city name of Houston in IPA: /ˈhjuːstən/.
	 *
	 * @see https://schema.org/phoneticText
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/phoneticText'])]
	private ?string $phoneticText = null;

	/**
	 * Text value being annotated.
	 *
	 * @see https://schema.org/textValue
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/textValue'])]
	private ?string $textValue = null;

	/**
	 * Form of markup used. eg. \[SSML\](https://www.w3.org/TR/speech-synthesis11) or \[IPA\](https://www.wikidata.org/wiki/Property:P898).
	 *
	 * @see https://schema.org/speechToTextMarkup
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/speechToTextMarkup'])]
	private ?string $speechToTextMarkup = null;

	public function setInLanguage(?string $inLanguage): void
	{
		$this->inLanguage = $inLanguage;
	}

	public function getInLanguage(): ?string
	{
		return $this->inLanguage;
	}

	public function setPhoneticText(?string $phoneticText): void
	{
		$this->phoneticText = $phoneticText;
	}

	public function getPhoneticText(): ?string
	{
		return $this->phoneticText;
	}

	public function setTextValue(?string $textValue): void
	{
		$this->textValue = $textValue;
	}

	public function getTextValue(): ?string
	{
		return $this->textValue;
	}

	public function setSpeechToTextMarkup(?string $speechToTextMarkup): void
	{
		$this->speechToTextMarkup = $speechToTextMarkup;
	}

	public function getSpeechToTextMarkup(): ?string
	{
		return $this->speechToTextMarkup;
	}
}
