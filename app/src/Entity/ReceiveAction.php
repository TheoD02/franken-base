<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Enum\DeliveryMethod;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The act of physically/electronically taking delivery of an object that has been transferred from an origin to a destination. Reciprocal of SendAction.\\n\\nRelated actions:\\n\\n\* \[\[SendAction\]\]: The reciprocal of ReceiveAction.\\n\* \[\[TakeAction\]\]: Unlike TakeAction, ReceiveAction does not imply that the ownership has been transferred (e.g. I can receive a package, but it does not mean the package is now mine).
 *
 * @see https://schema.org/ReceiveAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ReceiveAction'])]
class ReceiveAction extends TransferAction
{
    /**
     * A sub property of participant. The participant who is at the sending end of the action.
     *
     * @see https://schema.org/sender
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/sender'])]
    #[Assert\NotNull]
    private Organization $sender;

    /**
     * A sub property of instrument. The method of delivery.
     *
     * @see https://schema.org/deliveryMethod
     */
    #[ORM\Column]
    #[ApiProperty(types: ['https://schema.org/deliveryMethod'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [DeliveryMethod::class, 'toArray'])]
    private string $deliveryMethod;

    public function setSender(Organization $sender): void
    {
        $this->sender = $sender;
    }

    public function getSender(): Organization
    {
        return $this->sender;
    }

    public function setDeliveryMethod(string $deliveryMethod): void
    {
        $this->deliveryMethod = $deliveryMethod;
    }

    public function getDeliveryMethod(): string
    {
        return $this->deliveryMethod;
    }
}
