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
 * A TV episode which can be part of a series or season.
 *
 * @see https://schema.org/TVEpisode
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TVEpisode'])]
class TVEpisode extends Episode
{
	/**
	 * An \[EIDR\](https://eidr.org/) (Entertainment Identifier Registry) \[\[identifier\]\] representing at the most general/abstract level, a work of film or television. For example, the motion picture known as "Ghostbusters" has a titleEIDR of "10.5240/7EC7-228A-510A-053E-CBB8-J". This title (or work) may have several variants, which EIDR calls "edits". See \[\[editEIDR\]\]. Since schema.org types like \[\[Movie\]\], \[\[TVEpisode\]\], \[\[TVSeason\]\], and \[\[TVSeries\]\] can be used for both works and their multiple expressions, it is possible to use \[\[titleEIDR\]\] alone (for a general description), or alongside \[\[editEIDR\]\] for a more edit-specific description.
	 *
	 * @see https://schema.org/titleEIDR
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/titleEIDR'])]
	private ?string $titleEIDR = null;

	/**
	 * Languages in which subtitles/captions are available, in \[IETF BCP 47 standard format\](http://tools.ietf.org/html/bcp47).
	 *
	 * @see https://schema.org/subtitleLanguage
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/subtitleLanguage'])]
	private ?string $subtitleLanguage = null;

	public function setTitleEIDR(?string $titleEIDR): void
	{
		$this->titleEIDR = $titleEIDR;
	}

	public function getTitleEIDR(): ?string
	{
		return $this->titleEIDR;
	}

	public function setSubtitleLanguage(?string $subtitleLanguage): void
	{
		$this->subtitleLanguage = $subtitleLanguage;
	}

	public function getSubtitleLanguage(): ?string
	{
		return $this->subtitleLanguage;
	}
}
