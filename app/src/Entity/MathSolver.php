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
 * A math solver which is capable of solving a subset of mathematical problems.
 *
 * @see https://schema.org/MathSolver
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MathSolver'])]
class MathSolver extends CreativeWork
{
	/**
	 * A mathematical expression (e.g. 'x^2-3x=0') that may be solved for a specific variable, simplified, or transformed. This can take many formats, e.g. LaTeX, Ascii-Math, or math as you would write with a keyboard.
	 *
	 * @see https://schema.org/mathExpression
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\SolveMathAction')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/mathExpression'])]
	#[Assert\NotNull]
	private SolveMathAction $mathExpression;

	public function setMathExpression(SolveMathAction $mathExpression): void
	{
		$this->mathExpression = $mathExpression;
	}

	public function getMathExpression(): SolveMathAction
	{
		return $this->mathExpression;
	}
}
