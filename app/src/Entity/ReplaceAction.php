<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The act of editing a recipient by replacing an old object with a new object.
 *
 * @see https://schema.org/ReplaceAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ReplaceAction'])]
class ReplaceAction extends UpdateAction
{
    /**
     * A sub property of object. The object that replaces.
     *
     * @see https://schema.org/replacer
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Thing')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/replacer'])]
    #[Assert\NotNull]
    private Thing $replacer;

    /**
     * A sub property of object. The object that is being replaced.
     *
     * @see https://schema.org/replacee
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Thing')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/replacee'])]
    #[Assert\NotNull]
    private Thing $replacee;

    public function setReplacer(Thing $replacer): void
    {
        $this->replacer = $replacer;
    }

    public function getReplacer(): Thing
    {
        return $this->replacer;
    }

    public function setReplacee(Thing $replacee): void
    {
        $this->replacee = $replacee;
    }

    public function getReplacee(): Thing
    {
        return $this->replacee;
    }
}
