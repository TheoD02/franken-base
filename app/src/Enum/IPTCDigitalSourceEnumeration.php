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
 * [IPTC](https://www.iptc.org/) "Digital Source" codes for use with the \[\[digitalSourceType\]\] property, providing information about the source for a digital media object. In general these codes are not declared here to be mutually exclusive, although some combinations would be contradictory if applied simultaneously, or might be considered mutually incompatible by upstream maintainers of the definitions. See the IPTC [documentation](https://www.iptc.org/std/photometadata/documentation/userguide/) for [detailed definitions](https://cv.iptc.org/newscodes/digitalsourcetype/) of all terms.
 *
 * @see https://schema.org/IPTCDigitalSourceEnumeration
 */
class IPTCDigitalSourceEnumeration extends Enum
{
	/** @var string Content coded as '[digital art](https://cv.iptc.org/newscodes/digitalsourcetype/digitalArt)' using the IPTC [digital source type](https://cv.iptc.org/newscodes/digitalsourcetype/) vocabulary. */
	public const DIGITAL_ART_DIGITAL_SOURCE = 'https://schema.org/DigitalArtDigitalSource';

	/** @var string Content coded as '[algorithmic media](https://cv.iptc.org/newscodes/digitalsourcetype/algorithmicMedia)' using the IPTC [digital source type](https://cv.iptc.org/newscodes/digitalsourcetype/) vocabulary. */
	public const ALGORITHMIC_MEDIA_DIGITAL_SOURCE = 'https://schema.org/AlgorithmicMediaDigitalSource';

	/** @var string Content coded as '[composite capture](https://cv.iptc.org/newscodes/digitalsourcetype/compositeCapture)' using the IPTC [digital source type](https://cv.iptc.org/newscodes/digitalsourcetype/) vocabulary. */
	public const COMPOSITE_CAPTURE_DIGITAL_SOURCE = 'https://schema.org/CompositeCaptureDigitalSource';

	/** @var string Content coded as '[minor human edits](https://cv.iptc.org/newscodes/digitalsourcetype/minorHumanEdits)' using the IPTC [digital source type](https://cv.iptc.org/newscodes/digitalsourcetype/) vocabulary. */
	public const MINOR_HUMAN_EDITS_DIGITAL_SOURCE = 'https://schema.org/MinorHumanEditsDigitalSource';

	/** @var string Content coded as '[trained algorithmic media](https://cv.iptc.org/newscodes/digitalsourcetype/trainedAlgorithmicMedia)' using the IPTC [digital source type](https://cv.iptc.org/newscodes/digitalsourcetype/) vocabulary. */
	public const TRAINED_ALGORITHMIC_MEDIA_DIGITAL_SOURCE = 'https://schema.org/TrainedAlgorithmicMediaDigitalSource';

	/** @var string Content coded as '[composite synthetic](https://cv.iptc.org/newscodes/digitalsourcetype/compositeSynthetic)' using the IPTC [digital source type](https://cv.iptc.org/newscodes/digitalsourcetype/) vocabulary. */
	public const COMPOSITE_SYNTHETIC_DIGITAL_SOURCE = 'https://schema.org/CompositeSyntheticDigitalSource';

	/** @var string Content coded as '[virtual recording](https://cv.iptc.org/newscodes/digitalsourcetype/virtualRecording)' using the IPTC [digital source type](https://cv.iptc.org/newscodes/digitalsourcetype/) vocabulary. */
	public const VIRTUAL_RECORDING_DIGITAL_SOURCE = 'https://schema.org/VirtualRecordingDigitalSource';

	/** @var string Content coded as '[algorithmically enhanced](https://cv.iptc.org/newscodes/digitalsourcetype/algorithmicallyEnhanced)' using the IPTC [digital source type](https://cv.iptc.org/newscodes/digitalsourcetype/) vocabulary. */
	public const ALGORITHMICALLY_ENHANCED_DIGITAL_SOURCE = 'https://schema.org/AlgorithmicallyEnhancedDigitalSource';

	/** @var string Content coded as '[positive film](https://cv.iptc.org/newscodes/digitalsourcetype/positiveFilm)' using the IPTC [digital source type](https://cv.iptc.org/newscodes/digitalsourcetype/) vocabulary. */
	public const POSITIVE_FILM_DIGITAL_SOURCE = 'https://schema.org/PositiveFilmDigitalSource';

	/** @var string Content coded as '[data driven media](https://cv.iptc.org/newscodes/digitalsourcetype/dataDrivenMedia)' using the IPTC [digital source type](https://cv.iptc.org/newscodes/digitalsourcetype/) vocabulary. */
	public const DATA_DRIVEN_MEDIA_DIGITAL_SOURCE = 'https://schema.org/DataDrivenMediaDigitalSource';

	/** @var string Content coded as '[composite with trained algorithmic media](https://cv.iptc.org/newscodes/digitalsourcetype/compositeWithTrainedAlgorithmicMedia)' using the IPTC [digital source type](https://cv.iptc.org/newscodes/digitalsourcetype/) vocabulary. */
	public const COMPOSITE_WITH_TRAINED_ALGORITHMIC_MEDIA_DIGITAL_SOURCE = 'https://schema.org/CompositeWithTrainedAlgorithmicMediaDigitalSource';

	/** @var string Content coded as '[digital capture](https://cv.iptc.org/newscodes/digitalsourcetype/digitalCapture)' using the IPTC [digital source type](https://cv.iptc.org/newscodes/digitalsourcetype/) vocabulary. */
	public const DIGITAL_CAPTURE_DIGITAL_SOURCE = 'https://schema.org/DigitalCaptureDigitalSource';

	/** @var string Content coded as '[print](https://cv.iptc.org/newscodes/digitalsourcetype/print)' using the IPTC [digital source type](https://cv.iptc.org/newscodes/digitalsourcetype/) vocabulary. */
	public const PRINT_DIGITAL_SOURCE = 'https://schema.org/PrintDigitalSource';

	/** @var string Content coded as '[negative film](https://cv.iptc.org/newscodes/digitalsourcetype/negativeFilm)' using the IPTC [digital source type](https://cv.iptc.org/newscodes/digitalsourcetype/) vocabulary. */
	public const NEGATIVE_FILM_DIGITAL_SOURCE = 'https://schema.org/NegativeFilmDigitalSource';
}
