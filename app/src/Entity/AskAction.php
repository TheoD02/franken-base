<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The act of posing a question / favor to someone.\\n\\nRelated actions:\\n\\n\* \[\[ReplyAction\]\]: Appears generally as a response to AskAction.
 *
 * @see https://schema.org/AskAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/AskAction'])]
class AskAction extends CommunicateAction
{
    /**
     * A sub property of object. A question.
     *
     * @see https://schema.org/question
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Question')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/question'])]
    #[Assert\NotNull]
    private Question $question;

    public function setQuestion(Question $question): void
    {
        $this->question = $question;
    }

    public function getQuestion(): Question
    {
        return $this->question;
    }
}
