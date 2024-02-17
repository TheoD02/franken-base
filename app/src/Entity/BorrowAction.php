<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The act of obtaining an object under an agreement to return it at a later date. Reciprocal of LendAction.\\n\\nRelated actions:\\n\\n\* \[\[LendAction\]\]: Reciprocal of BorrowAction.
 *
 * @see https://schema.org/BorrowAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/BorrowAction'])]
class BorrowAction extends TransferAction
{
    /**
     * A sub property of participant. The person that lends the object being borrowed.
     *
     * @see https://schema.org/lender
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/lender'])]
    #[Assert\NotNull]
    private Person $lender;

    public function setLender(Person $lender): void
    {
        $this->lender = $lender;
    }

    public function getLender(): Person
    {
        return $this->lender;
    }
}
