<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * The act of finding an object.\\n\\nRelated actions:\\n\\n\* \[\[SearchAction\]\]: FindAction is generally lead by a SearchAction, but not necessarily.
 *
 * @see https://schema.org/FindAction
 */
#[ORM\MappedSuperclass]
abstract class FindAction extends Action
{
}
