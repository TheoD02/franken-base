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
 * The frequency in MHz and the modulation used for a particular BroadcastService.
 *
 * @see https://schema.org/BroadcastFrequencySpecification
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/BroadcastFrequencySpecification'])]
class BroadcastFrequencySpecification extends Intangible
{
	/**
	 * The modulation (e.g. FM, AM, etc) used by a particular broadcast service.
	 *
	 * @see https://schema.org/broadcastSignalModulation
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/broadcastSignalModulation'])]
	private ?string $broadcastSignalModulation = null;

	/**
	 * The subchannel used for the broadcast.
	 *
	 * @see https://schema.org/broadcastSubChannel
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/broadcastSubChannel'])]
	private ?string $broadcastSubChannel = null;

	/**
	 * The frequency in MHz for a particular broadcast.
	 *
	 * @see https://schema.org/broadcastFrequencyValue
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
	#[ApiProperty(types: ['https://schema.org/broadcastFrequencyValue'])]
	private ?QuantitativeValue $broadcastFrequencyValue = null;

	public function setBroadcastSignalModulation(?string $broadcastSignalModulation): void
	{
		$this->broadcastSignalModulation = $broadcastSignalModulation;
	}

	public function getBroadcastSignalModulation(): ?string
	{
		return $this->broadcastSignalModulation;
	}

	public function setBroadcastSubChannel(?string $broadcastSubChannel): void
	{
		$this->broadcastSubChannel = $broadcastSubChannel;
	}

	public function getBroadcastSubChannel(): ?string
	{
		return $this->broadcastSubChannel;
	}

	public function setBroadcastFrequencyValue(?QuantitativeValue $broadcastFrequencyValue): void
	{
		$this->broadcastFrequencyValue = $broadcastFrequencyValue;
	}

	public function getBroadcastFrequencyValue(): ?QuantitativeValue
	{
		return $this->broadcastFrequencyValue;
	}
}
