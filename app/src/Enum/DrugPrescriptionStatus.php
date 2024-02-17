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
 * Indicates whether this drug is available by prescription or over-the-counter.
 *
 * @see https://schema.org/DrugPrescriptionStatus
 */
class DrugPrescriptionStatus extends Enum
{
	/** @var string The character of a medical substance, typically a medicine, of being available over the counter or not. */
	public const O_T_C = 'https://schema.org/OTC';

	/** @var string Available by prescription only. */
	public const PRESCRIPTION_ONLY = 'https://schema.org/PrescriptionOnly';
}
