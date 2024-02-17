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
 * An enumeration that describes different types of medical procedures.
 *
 * @see https://schema.org/MedicalProcedureType
 */
class MedicalProcedureType extends Enum
{
	/** @var string A type of medical procedure that involves percutaneous techniques, where access to organs or tissue is achieved via needle-puncture of the skin. For example, catheter-based procedures like stent delivery. */
	public const PERCUTANEOUS_PROCEDURE = 'https://schema.org/PercutaneousProcedure';

	/** @var string A type of medical procedure that involves noninvasive techniques. */
	public const NONINVASIVE_PROCEDURE = 'https://schema.org/NoninvasiveProcedure';
}
