<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * A delivery method is a standardized procedure for transferring the product or service to the destination of fulfillment chosen by the customer. Delivery methods are characterized by the means of transportation used, and by the organization or group that is the contracting party for the sending organization or person.\\n\\nCommonly used values:\\n\\n\* http://purl.org/goodrelations/v1#DeliveryModeDirectDownload\\n\* http://purl.org/goodrelations/v1#DeliveryModeFreight\\n\* http://purl.org/goodrelations/v1#DeliveryModeMail\\n\* http://purl.org/goodrelations/v1#DeliveryModeOwnFleet\\n\* http://purl.org/goodrelations/v1#DeliveryModePickUp\\n\* http://purl.org/goodrelations/v1#DHL\\n\* http://purl.org/goodrelations/v1#FederalExpress\\n\* http://purl.org/goodrelations/v1#UPS.
 *
 * @see https://schema.org/DeliveryMethod
 */
class DeliveryMethod extends Enum
{
    /** @var string A private parcel service as the delivery mode available for a certain offer.\\n\\nCommonly used values:\\n\\n\* http://purl.org/goodrelations/v1#DHL\\n\* http://purl.org/goodrelations/v1#FederalExpress\\n\* http://purl.org/goodrelations/v1#UPS */
    public const PARCEL_SERVICE = 'https://schema.org/ParcelService';

    /** @var string A DeliveryMethod in which an item is made available via locker. */
    public const LOCKER_DELIVERY = 'https://schema.org/LockerDelivery';

    /** @var string A DeliveryMethod in which an item is collected on site, e.g. in a store or at a box office. */
    public const ON_SITE_PICKUP = 'https://schema.org/OnSitePickup';
}
