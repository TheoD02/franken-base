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
 * Systems of medical practice.
 *
 * @see https://schema.org/MedicineSystem
 */
class MedicineSystem extends Enum
{
	/** @var string A system of medicine based on the principle that a disease can be cured by a substance that produces similar symptoms in healthy people. */
	public const HOMEOPATHIC = 'https://schema.org/Homeopathic';

	/** @var string A system of medicine focused on the relationship between the body's structure, mainly the spine, and its functioning. */
	public const CHIROPRACTIC = 'https://schema.org/Chiropractic';

	/** @var string A system of medicine focused on promoting the body's innate ability to heal itself. */
	public const OSTEOPATHIC = 'https://schema.org/Osteopathic';

	/** @var string A system of medicine that originated in India over thousands of years and that focuses on integrating and balancing the body, mind, and spirit. */
	public const AYURVEDIC = 'https://schema.org/Ayurvedic';

	/** @var string The conventional Western system of medicine, that aims to apply the best available evidence gained from the scientific method to clinical decision making. Also known as conventional or Western medicine. */
	public const WESTERN_CONVENTIONAL = 'https://schema.org/WesternConventional';

	/** @var string A system of medicine based on common theoretical concepts that originated in China and evolved over thousands of years, that uses herbs, acupuncture, exercise, massage, dietary therapy, and other methods to treat a wide range of conditions. */
	public const TRADITIONAL_CHINESE = 'https://schema.org/TraditionalChinese';
}
