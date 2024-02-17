<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * The act of responding instinctively and emotionally to an object, expressing a sentiment.
 *
 * @see https://schema.org/ReactAction
 */
#[ORM\MappedSuperclass]
abstract class ReactAction extends AssessAction
{
}
