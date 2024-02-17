<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An application programming interface accessible over Web/Internet technologies.
 *
 * @see https://schema.org/WebAPI
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/WebAPI'])]
class WebAPI extends Service
{
    /**
     * Further documentation describing the Web API in more detail.
     *
     * @see https://schema.org/documentation
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
    #[ApiProperty(types: ['https://schema.org/documentation'])]
    #[Assert\Url]
    private ?string $documentation = null;

    public function setDocumentation(?string $documentation): void
    {
        $this->documentation = $documentation;
    }

    public function getDocumentation(): ?string
    {
        return $this->documentation;
    }
}
