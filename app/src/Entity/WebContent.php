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
 * WebContent is a type representing all \[\[WebPage\]\], \[\[WebSite\]\] and \[\[WebPageElement\]\] content. It is sometimes the case that detailed distinctions between Web pages, sites and their parts are not always important or obvious. The \[\[WebContent\]\] type makes it easier to describe Web-addressable content without requiring such distinctions to always be stated. (The intent is that the existing types \[\[WebPage\]\], \[\[WebSite\]\] and \[\[WebPageElement\]\] will eventually be declared as subtypes of \[\[WebContent\]\].)
 *
 * @see https://schema.org/WebContent
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap(['webContent' => WebContent::class, 'healthTopicContent' => HealthTopicContent::class])]
class WebContent extends CreativeWork
{
}
