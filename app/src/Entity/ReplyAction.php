<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The act of responding to a question/message asked/sent by the object. Related to \[\[AskAction\]\].\\n\\nRelated actions:\\n\\n\* \[\[AskAction\]\]: Appears generally as an origin of a ReplyAction.
 *
 * @see https://schema.org/ReplyAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ReplyAction'])]
class ReplyAction extends CommunicateAction
{
    /**
     * A sub property of result. The Comment created or sent as a result of this action.
     *
     * @see https://schema.org/resultComment
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Comment')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/resultComment'])]
    #[Assert\NotNull]
    private Comment $resultComment;

    public function setResultComment(Comment $resultComment): void
    {
        $this->resultComment = $resultComment;
    }

    public function getResultComment(): Comment
    {
        return $this->resultComment;
    }
}
