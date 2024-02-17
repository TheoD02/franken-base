<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Target audiences types for medical web pages. Enumerated type.
 *
 * @see https://schema.org/MedicalAudienceType
 */
class MedicalAudienceType extends Enum
{
    /** @var string Medical clinicians, including practicing physicians and other medical professionals involved in clinical practice. */
    public const CLINICIAN = 'https://schema.org/Clinician';

    /** @var string Medical researchers. */
    public const MEDICAL_RESEARCHER = 'https://schema.org/MedicalResearcher';
}
