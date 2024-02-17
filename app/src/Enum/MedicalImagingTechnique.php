<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Any medical imaging modality typically used for diagnostic purposes. Enumerated type.
 *
 * @see https://schema.org/MedicalImagingTechnique
 */
class MedicalImagingTechnique extends Enum
{
    /** @var string Ultrasound imaging. */
    public const ULTRASOUND = 'https://schema.org/Ultrasound';

    /** @var string Radiography is an imaging technique that uses electromagnetic radiation other than visible light, especially X-rays, to view the internal structure of a non-uniformly composed and opaque object such as the human body. */
    public const RADIOGRAPHY = 'https://schema.org/Radiography';

    /** @var string Positron emission tomography imaging. */
    public const P_E_T = 'https://schema.org/PET';

    /** @var string Magnetic resonance imaging. */
    public const M_R_I = 'https://schema.org/MRI';

    /** @var string X-ray computed tomography imaging. */
    public const C_T = 'https://schema.org/CT';

    /** @var string X-ray imaging. */
    public const X_RAY = 'https://schema.org/XRay';
}
