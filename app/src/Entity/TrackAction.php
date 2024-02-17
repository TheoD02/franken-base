<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Enum\DeliveryMethod;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An agent tracks an object for updates.\\n\\nRelated actions:\\n\\n\* \[\[FollowAction\]\]: Unlike FollowAction, TrackAction refers to the interest on the location of innanimates objects.\\n\* \[\[SubscribeAction\]\]: Unlike SubscribeAction, TrackAction refers to the interest on the location of innanimate objects.
 *
 * @see https://schema.org/TrackAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TrackAction'])]
class TrackAction extends FindAction
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

    public function setDeliveryMethod(string $deliveryMethod): void
    {
        $this->deliveryMethod = $deliveryMethod;
    }

    public function getDeliveryMethod(): string
    {
        return $this->deliveryMethod;
    }
}
