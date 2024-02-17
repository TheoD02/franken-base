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
 * The action that takes in a math expression and directs users to a page potentially capable of solving/simplifying that expression.
 *
 * @see https://schema.org/SolveMathAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SolveMathAction'])]
class SolveMathAction extends Action
{
	/**
	 * For questions that are part of learning resources (e.g. Quiz), eduQuestionType indicates the format of question being given. Example: "Multiple choice", "Open ended", "Flashcard".
	 *
	 * @see https://schema.org/eduQuestionType
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/eduQuestionType'])]
	private ?string $eduQuestionType = null;

	public function setEduQuestionType(?string $eduQuestionType): void
	{
		$this->eduQuestionType = $eduQuestionType;
	}

	public function getEduQuestionType(): ?string
	{
		return $this->eduQuestionType;
	}
}
