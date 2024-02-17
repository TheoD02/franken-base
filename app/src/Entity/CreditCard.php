<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A card payment method of a particular brand or name. Used to mark up a particular payment method and/or the financial product/service that supplies the card account.\\n\\nCommonly used values:\\n\\n\* http://purl.org/goodrelations/v1#AmericanExpress\\n\* http://purl.org/goodrelations/v1#DinersClub\\n\* http://purl.org/goodrelations/v1#Discover\\n\* http://purl.org/goodrelations/v1#JCB\\n\* http://purl.org/goodrelations/v1#MasterCard\\n\* http://purl.org/goodrelations/v1#VISA.
 *
 * @see https://schema.org/CreditCard
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/CreditCard'])]
class CreditCard extends PaymentCard
{
}
