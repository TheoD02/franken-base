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
 * The status of a medical study. Enumerated type.
 *
 * @see https://schema.org/MedicalStudyStatus
 */
class MedicalStudyStatus extends Enum
{
	/** @var string Recruiting participants. */
	public const RECRUITING = 'https://schema.org/Recruiting';

	/** @var string Enrolling participants by invitation only. */
	public const ENROLLING_BY_INVITATION = 'https://schema.org/EnrollingByInvitation';

	/** @var string Results are available. */
	public const RESULTS_AVAILABLE = 'https://schema.org/ResultsAvailable';

	/** @var string Not yet recruiting. */
	public const NOT_YET_RECRUITING = 'https://schema.org/NotYetRecruiting';

	/** @var string Withdrawn. */
	public const WITHDRAWN = 'https://schema.org/Withdrawn';

	/** @var string Completed. */
	public const COMPLETED = 'https://schema.org/Completed';

	/** @var string Terminated. */
	public const TERMINATED = 'https://schema.org/Terminated';

	/** @var string Results are not available. */
	public const RESULTS_NOT_AVAILABLE = 'https://schema.org/ResultsNotAvailable';

	/** @var string Active, but not recruiting new participants. */
	public const ACTIVE_NOT_RECRUITING = 'https://schema.org/ActiveNotRecruiting';

	/** @var string Suspended. */
	public const SUSPENDED = 'https://schema.org/Suspended';
}
