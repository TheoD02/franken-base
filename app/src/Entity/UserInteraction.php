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
 * UserInteraction and its subtypes is an old way of talking about users interacting with pages. It is generally better to use \[\[Action\]\]-based vocabulary, alongside types such as \[\[Comment\]\].
 *
 * @see https://schema.org/UserInteraction
 */
#[ORM\MappedSuperclass]
abstract class UserInteraction extends Event
{
}
