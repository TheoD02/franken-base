<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A component of the human body circulatory system comprised of an intricate network of hollow tubes that transport blood throughout the entire body.
 *
 * @see https://schema.org/Vessel
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
    'vessel' => Vessel::class,
    'artery' => Artery::class,
    'vein' => Vein::class,
    'lymphaticVessel' => LymphaticVessel::class,
])]
class Vessel extends AnatomicalStructure
{
}
