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
 * A specific question - e.g. from a user seeking answers online, or collected in a Frequently Asked Questions (FAQ) document.
 *
 * @see https://schema.org/Question
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Question'])]
class Question extends Comment
{
	/**
	 * @var Collection<ItemList>|null The answer(s) that has been accepted as best, typically on a Question/Answer site. Sites vary in their selection mechanisms, e.g. drawing on community opinion and/or the view of the Question author.
	 * @see https://schema.org/acceptedAnswer
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\ItemList')]
	#[ORM\JoinTable(name: 'question_item_list_accepted_answer')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/acceptedAnswer'])]
	private ?Collection $acceptedAnswer = null;

	/**
	 * An answer (possibly one of several, possibly incorrect) to a Question, e.g. on a Question/Answer site.
	 *
	 * @see https://schema.org/suggestedAnswer
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Answer')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/suggestedAnswer'])]
	#[Assert\NotNull]
	private Answer $suggestedAnswer;

	/**
	 * The number of answers this question has received.
	 *
	 * @see https://schema.org/answerCount
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
	#[ApiProperty(types: ['https://schema.org/answerCount'])]
	private ?int $answerCount = null;

	/**
	 * For questions that are part of learning resources (e.g. Quiz), eduQuestionType indicates the format of question being given. Example: "Multiple choice", "Open ended", "Flashcard".
	 *
	 * @see https://schema.org/eduQuestionType
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/eduQuestionType'])]
	private ?string $eduQuestionType = null;

	function __construct()
	{
		$this->acceptedAnswer = new ArrayCollection();
	}

	public function addAcceptedAnswer(ItemList $acceptedAnswer): void
	{
		$this->acceptedAnswer[] = $acceptedAnswer;
	}

	public function removeAcceptedAnswer(ItemList $acceptedAnswer): void
	{
		$this->acceptedAnswer->removeElement($acceptedAnswer);
	}

	/**
	 * @return Collection<ItemList>|null
	 */
	public function getAcceptedAnswer(): Collection
	{
		return $this->acceptedAnswer;
	}

	public function setSuggestedAnswer(Answer $suggestedAnswer): void
	{
		$this->suggestedAnswer = $suggestedAnswer;
	}

	public function getSuggestedAnswer(): Answer
	{
		return $this->suggestedAnswer;
	}

	public function setAnswerCount(?int $answerCount): void
	{
		$this->answerCount = $answerCount;
	}

	public function getAnswerCount(): ?int
	{
		return $this->answerCount;
	}

	public function setEduQuestionType(?string $eduQuestionType): void
	{
		$this->eduQuestionType = $eduQuestionType;
	}

	public function getEduQuestionType(): ?string
	{
		return $this->eduQuestionType;
	}
}
