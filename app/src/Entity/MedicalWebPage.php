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
use App\Enum\MedicalAudienceType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A web page that provides medical information.
 *
 * @see https://schema.org/MedicalWebPage
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MedicalWebPage'])]
#[ORM\AssociationOverrides([
	new ORM\AssociationOverride(
		name: 'speakable',
		joinTable: new ORM\JoinTable(name: 'web_page_url_speakable_medical_web_page'),
		joinColumns: [new ORM\JoinColumn()],
		inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
	),
])]
class MedicalWebPage extends WebPage
{
	/**
	 * Medical audience for page.
	 *
	 * @see https://schema.org/medicalAudience
	 */
	#[ORM\Column]
	#[ApiProperty(types: ['https://schema.org/medicalAudience'])]
	#[Assert\NotNull]
	#[Assert\Choice(callback: [MedicalAudienceType::class, 'toArray'])]
	private string $medicalAudience;

	public function setMedicalAudience(string $medicalAudience): void
	{
		$this->medicalAudience = $medicalAudience;
	}

	public function getMedicalAudience(): string
	{
		return $this->medicalAudience;
	}
}
