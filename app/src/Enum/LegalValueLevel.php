<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * A list of possible levels for the legal validity of a legislation.
 *
 * @see https://schema.org/LegalValueLevel
 */
class LegalValueLevel extends Enum
{
    /** @var string Indicates a document for which the text is conclusively what the law says and is legally binding. (E.g. the digitally signed version of an Official Journal.) Something "Definitive" is considered to be also \[\[AuthoritativeLegalValue\]\]. */
    public const DEFINITIVE_LEGAL_VALUE = 'https://schema.org/DefinitiveLegalValue';

    /** @var string Indicates that a document has no particular or special standing (e.g. a republication of a law by a private publisher). */
    public const UNOFFICIAL_LEGAL_VALUE = 'https://schema.org/UnofficialLegalValue';

    /** @var string Indicates that the publisher gives some special status to the publication of the document. ("The Queens Printer" version of a UK Act of Parliament, or the PDF version of a Directive published by the EU Office of Publications.) Something "Authoritative" is considered to be also \[\[OfficialLegalValue\]\]. */
    public const AUTHORITATIVE_LEGAL_VALUE = 'https://schema.org/AuthoritativeLegalValue';

    /** @var string All the documents published by an official publisher should have at least the legal value level "OfficialLegalValue". This indicates that the document was published by an organisation with the public task of making it available (e.g. a consolidated version of an EU directive published by the EU Office of Publications). */
    public const OFFICIAL_LEGAL_VALUE = 'https://schema.org/OfficialLegalValue';
}
