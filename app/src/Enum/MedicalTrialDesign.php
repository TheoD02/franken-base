<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Design models for medical trials. Enumerated type.
 *
 * @see https://schema.org/MedicalTrialDesign
 */
class MedicalTrialDesign extends Enum
{
    /** @var string A trial that takes place at a single center. */
    public const SINGLE_CENTER_TRIAL = 'https://schema.org/SingleCenterTrial';

    /** @var string A randomized trial design. */
    public const RANDOMIZED_TRIAL = 'https://schema.org/RandomizedTrial';

    /** @var string A trial design in which neither the researcher, the person administering the therapy nor the patient knows the details of the treatment the patient was randomly assigned to. */
    public const TRIPLE_BLINDED_TRIAL = 'https://schema.org/TripleBlindedTrial';

    /** @var string A placebo-controlled trial design. */
    public const PLACEBO_CONTROLLED_TRIAL = 'https://schema.org/PlaceboControlledTrial';

    /** @var string A trial design in which neither the researcher nor the patient knows the details of the treatment the patient was randomly assigned to. */
    public const DOUBLE_BLINDED_TRIAL = 'https://schema.org/DoubleBlindedTrial';

    /** @var string An international trial. */
    public const INTERNATIONAL_TRIAL = 'https://schema.org/InternationalTrial';

    /** @var string A trial design in which the researcher knows the full details of the treatment, and so does the patient. */
    public const OPEN_TRIAL = 'https://schema.org/OpenTrial';

    /** @var string A trial design in which the researcher knows which treatment the patient was randomly assigned to but the patient does not. */
    public const SINGLE_BLINDED_TRIAL = 'https://schema.org/SingleBlindedTrial';

    /** @var string A trial that takes place at multiple centers. */
    public const MULTI_CENTER_TRIAL = 'https://schema.org/MultiCenterTrial';
}
