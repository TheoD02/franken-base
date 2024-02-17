<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Natural languages such as Spanish, Tamil, Hindi, English, etc. Formal language code tags expressed in \[BCP 47\](https://en.wikipedia.org/wiki/IETF\_language\_tag) can be used via the \[\[alternateName\]\] property. The Language type previously also covered programming languages such as Scheme and Lisp, which are now best represented using \[\[ComputerLanguage\]\].
 *
 * @see https://schema.org/Language
 */
#[ORM\Entity]
#[ORM\Table(name: '`language`')]
#[ApiResource(types: ['https://schema.org/Language'])]
class Language extends Intangible
{
}
