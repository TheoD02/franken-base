<?php

declare(strict_types=1);

namespace App\Suppliers\Enum;

enum SupplierBehavior: string
{
    case MANUFACTURER = 'MANUFACTURIER';
    case INTRA_GROUP = 'INTRAGROUPE';
    case ALTERNATIVE_WYZ = 'DEPANNAGE_WYZ';
}
