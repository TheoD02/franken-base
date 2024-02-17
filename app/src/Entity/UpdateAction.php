<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The act of managing by changing/editing the state of the object.
 *
 * @see https://schema.org/UpdateAction
 */
#[ORM\MappedSuperclass]
abstract class UpdateAction extends Action
{
    /**
     * A sub property of object. The collection target of the action.
     *
     * @see https://schema.org/targetCollection
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Thing')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/targetCollection'])]
    #[Assert\NotNull]
    private Thing $targetCollection;

    public function setTargetCollection(Thing $targetCollection): void
    {
        $this->targetCollection = $targetCollection;
    }

    public function getTargetCollection(): Thing
    {
        return $this->targetCollection;
    }
}
