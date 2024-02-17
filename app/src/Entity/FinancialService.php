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
 * Financial services business.
 *
 * @see https://schema.org/FinancialService
 */
#[ORM\MappedSuperclass]
abstract class FinancialService extends LocalBusiness
{
	/**
	 * Description of fees, commissions, and other terms applied either to a class of financial product, or by a financial service organization.
	 *
	 * @see https://schema.org/feesAndCommissionsSpecification
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/feesAndCommissionsSpecification'])]
	#[Assert\Url]
	private ?string $feesAndCommissionsSpecification = null;

	public function setFeesAndCommissionsSpecification(?string $feesAndCommissionsSpecification): void
	{
		$this->feesAndCommissionsSpecification = $feesAndCommissionsSpecification;
	}

	public function getFeesAndCommissionsSpecification(): ?string
	{
		return $this->feesAndCommissionsSpecification;
	}
}
