<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A table on a Web page.
 *
 * @see https://schema.org/Table
 */
#[ORM\Entity]
#[ORM\Table(name: '`table`')]
#[ApiResource(types: ['https://schema.org/Table'])]
class Table extends WebPageElement
{
}
