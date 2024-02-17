<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Enum\DeliveryMethod;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The act of physically/electronically dispatching an object for transfer from an origin to a destination. Related actions:\\n\\n\* \[\[ReceiveAction\]\]: The reciprocal of SendAction.\\n\* \[\[GiveAction\]\]: Unlike GiveAction, SendAction does not imply the transfer of ownership (e.g. I can send you my laptop, but I'm not necessarily giving it to you).
 *
 * @see https://schema.org/SendAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SendAction'])]
class SendAction extends TransferAction
{
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

    /**
     * A sub property of participant. The participant who is at the receiving end of the action.
     *
     * @see https://schema.org/recipient
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/recipient'])]
    #[Assert\NotNull]
    private Organization $recipient;

    public function setDeliveryMethod(string $deliveryMethod): void
    {
        $this->deliveryMethod = $deliveryMethod;
    }

    public function getDeliveryMethod(): string
    {
        return $this->deliveryMethod;
    }

    public function setRecipient(Organization $recipient): void
    {
        $this->recipient = $recipient;
    }

    public function getRecipient(): Organization
    {
        return $this->recipient;
    }
}
