<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A construction business.\\n\\nA HomeAndConstructionBusiness is a \[\[LocalBusiness\]\] that provides services around homes and buildings.\\n\\nAs a \[\[LocalBusiness\]\] it can be described as a \[\[provider\]\] of one or more \[\[Service\]\]\\(s).
 *
 * @see https://schema.org/HomeAndConstructionBusiness
 */
#[ORM\MappedSuperclass]
abstract class HomeAndConstructionBusiness extends LocalBusiness
{
}
