<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * This type covers computer programming languages such as Scheme and Lisp, as well as other language-like computer representations. Natural languages are best represented with the \[\[Language\]\] type.
 *
 * @see https://schema.org/ComputerLanguage
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ComputerLanguage'])]
class ComputerLanguage extends Intangible
{
}
