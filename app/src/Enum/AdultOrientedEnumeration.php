<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Enumeration of considerations that make a product relevant or potentially restricted for adults only.
 *
 * @see https://schema.org/AdultOrientedEnumeration
 */
class AdultOrientedEnumeration extends Enum
{
    /** @var string The item is dangerous and requires careful handling and/or special training of the user. See also the \[UN Model Classification\](https://unece.org/DAM/trans/danger/publi/unrec/rev17/English/02EREv17\_Part2.pdf) defining the 9 classes of dangerous goods such as explosives, gases, flammables, and more. */
    public const DANGEROUS_GOOD_CONSIDERATION = 'https://schema.org/DangerousGoodConsideration';

    /** @var string A general code for cases where relevance to children is reduced, e.g. adult education, mortgages, retirement-related products, etc. */
    public const REDUCED_RELEVANCE_FOR_CHILDREN_CONSIDERATION = 'https://schema.org/ReducedRelevanceForChildrenConsideration';

    /** @var string The item is intended to induce bodily harm, for example guns, mace, combat knives, brass knuckles, nail or other bombs, and spears. */
    public const WEAPON_CONSIDERATION = 'https://schema.org/WeaponConsideration';

    /** @var string Item is a narcotic as defined by the \[1961 UN convention\](https://www.incb.org/incb/en/narcotic-drugs/Yellowlist/yellow-list.html), for example marijuana or heroin. */
    public const NARCOTIC_CONSIDERATION = 'https://schema.org/NarcoticConsideration';

    /** @var string Item contains alcohol or promotes alcohol consumption. */
    public const ALCOHOL_CONSIDERATION = 'https://schema.org/AlcoholConsideration';

    /** @var string Item is a pharmaceutical (e.g., a prescription or OTC drug) or a restricted medical device. */
    public const HEALTHCARE_CONSIDERATION = 'https://schema.org/HealthcareConsideration';

    /** @var string The item is suitable only for adults, without indicating why. Due to widespread use of "adult" as a euphemism for "sexual", many such items are likely suited also for the SexualContentConsideration code. */
    public const UNCLASSIFIED_ADULT_CONSIDERATION = 'https://schema.org/UnclassifiedAdultConsideration';

    /** @var string The item contains sexually oriented content such as nudity, suggestive or explicit material, or related online services, or is intended to enhance sexual activity. Examples: Erotic videos or magazine, sexual enhancement devices, sex toys. */
    public const SEXUAL_CONTENT_CONSIDERATION = 'https://schema.org/SexualContentConsideration';

    /** @var string Item contains tobacco and/or nicotine, for example cigars, cigarettes, chewing tobacco, e-cigarettes, or hookahs. */
    public const TOBACCO_NICOTINE_CONSIDERATION = 'https://schema.org/TobaccoNicotineConsideration';

    /** @var string Item shows or promotes violence. */
    public const VIOLENCE_CONSIDERATION = 'https://schema.org/ViolenceConsideration';
}
