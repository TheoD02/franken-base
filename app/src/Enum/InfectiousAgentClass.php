<?php

namespace App\Enum;

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
use MyCLabs\Enum\Enum;

/**
 * Classes of agents or pathogens that transmit infectious diseases. Enumerated type.
 *
 * @see https://schema.org/InfectiousAgentClass
 */
class InfectiousAgentClass extends Enum
{
	/** @var string Pathogenic virus that causes viral infection. */
	public const VIRUS = 'https://schema.org/Virus';

	/** @var string Single-celled organism that causes an infection. */
	public const PROTOZOA = 'https://schema.org/Protozoa';

	/** @var string Multicellular parasite that causes an infection. */
	public const MULTICELLULAR_PARASITE = 'https://schema.org/MulticellularParasite';

	/** @var string Pathogenic bacteria that cause bacterial infection. */
	public const BACTERIA = 'https://schema.org/Bacteria';

	/** @var string A prion is an infectious agent composed of protein in a misfolded form. */
	public const PRION = 'https://schema.org/Prion';

	/** @var string Pathogenic fungus. */
	public const FUNGUS = 'https://schema.org/Fungus';
}
