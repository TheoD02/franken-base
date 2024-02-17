<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A scholarly article.
 *
 * @see https://schema.org/ScholarlyArticle
 */
#[ORM\MappedSuperclass]
abstract class ScholarlyArticle extends Article
{
}
