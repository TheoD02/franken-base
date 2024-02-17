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
 * A point in time recurring on multiple days in the form hh:mm:ss\[Z|(+|-)hh:mm\] (see \[XML schema for details\](http://www.w3.org/TR/xmlschema-2/#time)).
 *
 * @see https://schema.org/Time
 */
#[ORM\Entity]
#[ORM\Table(name: '`time`')]
#[ApiResource(types: ['https://schema.org/Time'])]
class Time
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
