<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * A type of permission which can be granted for accessing a digital document.
 *
 * @see https://schema.org/DigitalDocumentPermissionType
 */
class DigitalDocumentPermissionType extends Enum
{
    /** @var string Permission to write or edit the document. */
    public const WRITE_PERMISSION = 'https://schema.org/WritePermission';

    /** @var string Permission to add comments to the document. */
    public const COMMENT_PERMISSION = 'https://schema.org/CommentPermission';

    /** @var string Permission to read or view the document. */
    public const READ_PERMISSION = 'https://schema.org/ReadPermission';
}
