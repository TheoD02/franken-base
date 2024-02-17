<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\Post;
use Doctrine\ORM\Mapping as ORM;

/**
 * A publication in any medium issued in successive parts bearing numerical or chronological designations and intended to continue indefinitely, such as a magazine, scholarly journal, or newspaper.\\n\\nSee also \[blog post\](http://blog.schema.org/2014/09/schemaorg-support-for-bibliographic\_2.html).
 *
 * @see https://schema.org/Periodical
 */
#[ORM\MappedSuperclass]
abstract class Periodical extends CreativeWorkSeries
{
}
