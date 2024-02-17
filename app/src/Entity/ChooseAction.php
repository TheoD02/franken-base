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
 * The act of expressing a preference from a set of options or a large or unbounded set of choices/options.
 *
 * @see https://schema.org/ChooseAction
 */
#[ORM\MappedSuperclass]
abstract class ChooseAction extends AssessAction
{
	/**
	 * A sub property of object. The options subject to this action.
	 *
	 * @see https://schema.org/actionOption
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Thing')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/actionOption'])]
	#[Assert\NotNull]
	private Thing $actionOption;

	public function setActionOption(Thing $actionOption): void
	{
		$this->actionOption = $actionOption;
	}

	public function getActionOption(): Thing
	{
		return $this->actionOption;
	}
}
