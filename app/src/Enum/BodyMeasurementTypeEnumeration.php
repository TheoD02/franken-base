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
 * Enumerates types (or dimensions) of a person's body measurements, for example for fitting of clothes.
 *
 * @see https://schema.org/BodyMeasurementTypeEnumeration
 */
class BodyMeasurementTypeEnumeration extends Enum
{
	/** @var string Foot length (measured between end of the most prominent toe and the most prominent part of the heel). Used, for example, to measure socks. */
	public const BODY_MEASUREMENT_FOOT = 'https://schema.org/BodyMeasurementFoot';

	/** @var string Girth of hips (measured around the buttocks). Used, for example, to fit skirts. */
	public const BODY_MEASUREMENT_HIPS = 'https://schema.org/BodyMeasurementHips';

	/** @var string Girth of body just below the bust. Used, for example, to fit women's swimwear. */
	public const BODY_MEASUREMENT_UNDERBUST = 'https://schema.org/BodyMeasurementUnderbust';

	/** @var string Body weight. Used, for example, to measure pantyhose. */
	public const BODY_MEASUREMENT_WEIGHT = 'https://schema.org/BodyMeasurementWeight';

	/** @var string Maximum girth of head above the ears. Used, for example, to fit hats. */
	public const BODY_MEASUREMENT_HEAD = 'https://schema.org/BodyMeasurementHead';

	/** @var string Body height (measured between crown of head and soles of feet). Used, for example, to fit jackets. */
	public const BODY_MEASUREMENT_HEIGHT = 'https://schema.org/BodyMeasurementHeight';

	/** @var string Girth of natural waistline (between hip bones and lower ribs). Used, for example, to fit pants. */
	public const BODY_MEASUREMENT_WAIST = 'https://schema.org/BodyMeasurementWaist';

	/** @var string Arm length (measured between arms/shoulder line intersection and the prominent wrist bone). Used, for example, to fit shirts. */
	public const BODY_MEASUREMENT_ARM = 'https://schema.org/BodyMeasurementArm';

	/** @var string Maximum girth of bust. Used, for example, to fit women's suits. */
	public const BODY_MEASUREMENT_BUST = 'https://schema.org/BodyMeasurementBust';

	/** @var string Maximum girth of chest. Used, for example, to fit men's suits. */
	public const BODY_MEASUREMENT_CHEST = 'https://schema.org/BodyMeasurementChest';

	/** @var string Inside leg (measured between crotch and soles of feet). Used, for example, to fit pants. */
	public const BODY_MEASUREMENT_INSIDE_LEG = 'https://schema.org/BodyMeasurementInsideLeg';

	/** @var string Girth of neck. Used, for example, to fit shirts. */
	public const BODY_MEASUREMENT_NECK = 'https://schema.org/BodyMeasurementNeck';

	/** @var string Maximum hand girth (measured over the knuckles of the open right hand excluding thumb, fingers together). Used, for example, to fit gloves. */
	public const BODY_MEASUREMENT_HAND = 'https://schema.org/BodyMeasurementHand';
}
