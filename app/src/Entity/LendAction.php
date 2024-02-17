<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The act of providing an object under an agreement that it will be returned at a later date. Reciprocal of BorrowAction.\\n\\nRelated actions:\\n\\n\* \[\[BorrowAction\]\]: Reciprocal of LendAction.
 *
 * @see https://schema.org/LendAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/LendAction'])]
class LendAction extends TransferAction
{
    /**
     * A sub property of participant. The person that borrows the object being lent.
     *
     * @see https://schema.org/borrower
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/borrower'])]
    #[Assert\NotNull]
    private Person $borrower;

    public function setBorrower(Person $borrower): void
    {
        $this->borrower = $borrower;
    }

    public function getBorrower(): Person
    {
        return $this->borrower;
    }
}
