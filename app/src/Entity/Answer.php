<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An answer offered to a question; perhaps correct, perhaps opinionated or wrong.
 *
 * @see https://schema.org/Answer
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Answer'])]
class Answer extends Comment
{
    /**
     * A step-by-step or full explanation about Answer. Can outline how this Answer was achieved or contain more broad clarification or statement about it.
     *
     * @see https://schema.org/answerExplanation
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\WebContent')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/answerExplanation'])]
    #[Assert\NotNull]
    private WebContent $answerExplanation;

    public function setAnswerExplanation(WebContent $answerExplanation): void
    {
        $this->answerExplanation = $answerExplanation;
    }

    public function getAnswerExplanation(): WebContent
    {
        return $this->answerExplanation;
    }
}
