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
 * Categories of physical activity, organized by physiologic classification.
 *
 * @see https://schema.org/PhysicalActivityCategory
 */
class PhysicalActivityCategory extends Enum
{
	/** @var string Physical activity of relatively low intensity that depends primarily on the aerobic energy-generating process; during activity, the aerobic metabolism uses oxygen to adequately meet energy demands during exercise. */
	public const AEROBIC_ACTIVITY = 'https://schema.org/AerobicActivity';

	/** @var string Physical activity that is engaged in to improve muscle and bone strength. Also referred to as resistance training. */
	public const STRENGTH_TRAINING = 'https://schema.org/StrengthTraining';

	/** @var string Any physical activity engaged in for recreational purposes. Examples may include ballroom dancing, roller skating, canoeing, fishing, etc. */
	public const LEISURE_TIME_ACTIVITY = 'https://schema.org/LeisureTimeActivity';

	/** @var string Physical activity that is engaged in to improve joint and muscle flexibility. */
	public const FLEXIBILITY = 'https://schema.org/Flexibility';

	/** @var string Physical activity that is engaged to help maintain posture and balance. */
	public const BALANCE = 'https://schema.org/Balance';

	/** @var string Physical activity that is of high-intensity which utilizes the anaerobic metabolism of the body. */
	public const ANAEROBIC_ACTIVITY = 'https://schema.org/AnaerobicActivity';

	/** @var string Any physical activity engaged in for job-related purposes. Examples may include waiting tables, maid service, carrying a mailbag, picking fruits or vegetables, construction work, etc. */
	public const OCCUPATIONAL_ACTIVITY = 'https://schema.org/OccupationalActivity';
}
