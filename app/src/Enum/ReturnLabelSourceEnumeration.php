<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Enumerates several types of return labels for product returns.
 *
 * @see https://schema.org/ReturnLabelSourceEnumeration
 */
class ReturnLabelSourceEnumeration extends Enum
{
    /** @var string Indicated that a return label must be downloaded and printed by the customer. */
    public const RETURN_LABEL_DOWNLOAD_AND_PRINT = 'https://schema.org/ReturnLabelDownloadAndPrint';

    /** @var string Specifies that a return label will be provided by the seller in the shipping box. */
    public const RETURN_LABEL_IN_BOX = 'https://schema.org/ReturnLabelInBox';

    /** @var string Indicated that creating a return label is the responsibility of the customer. */
    public const RETURN_LABEL_CUSTOMER_RESPONSIBILITY = 'https://schema.org/ReturnLabelCustomerResponsibility';
}
