<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of capturing sound and moving images on film, video, or digitally.
 *
 * @see https://schema.org/FilmAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/FilmAction'])]
class FilmAction extends CreateAction
{
}
