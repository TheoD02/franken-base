<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Original definition: "provider of professional services."\\n\\nThe general \[\[ProfessionalService\]\] type for local businesses was deprecated due to confusion with \[\[Service\]\]. For reference, the types that it included were: \[\[Dentist\]\], \[\[AccountingService\]\], \[\[Attorney\]\], \[\[Notary\]\], as well as types for several kinds of \[\[HomeAndConstructionBusiness\]\]: \[\[Electrician\]\], \[\[GeneralContractor\]\], \[\[HousePainter\]\], \[\[Locksmith\]\], \[\[Plumber\]\], \[\[RoofingContractor\]\]. \[\[LegalService\]\] was introduced as a more inclusive supertype of \[\[Attorney\]\].
 *
 * @see https://schema.org/ProfessionalService
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ProfessionalService'])]
class ProfessionalService extends LocalBusiness
{
}
