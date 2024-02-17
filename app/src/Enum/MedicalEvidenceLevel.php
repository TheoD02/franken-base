<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Level of evidence for a medical guideline. Enumerated type.
 *
 * @see https://schema.org/MedicalEvidenceLevel
 */
class MedicalEvidenceLevel extends Enum
{
    /** @var string Only consensus opinion of experts, case studies, or standard-of-care. */
    public const EVIDENCE_LEVEL_C = 'https://schema.org/EvidenceLevelC';

    /** @var string Data derived from multiple randomized clinical trials or meta-analyses. */
    public const EVIDENCE_LEVEL_A = 'https://schema.org/EvidenceLevelA';

    /** @var string Data derived from a single randomized trial, or nonrandomized studies. */
    public const EVIDENCE_LEVEL_B = 'https://schema.org/EvidenceLevelB';
}
