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
 * An enterprise (potentially individual but typically collaborative), planned to achieve a particular aim. Use properties from \[\[Organization\]\], \[\[subOrganization\]\]/\[\[parentOrganization\]\] to indicate project sub-structures.
 *
 * @see https://schema.org/Project
 */
#[ORM\MappedSuperclass]
abstract class Project extends Organization
{
}
