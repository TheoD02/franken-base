<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The act of generating a comment about a subject.
 *
 * @see https://schema.org/CommentAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/CommentAction'])]
class CommentAction extends CommunicateAction
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
