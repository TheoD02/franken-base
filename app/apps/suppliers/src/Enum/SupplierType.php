<?php

declare(strict_types=1);

namespace App\Suppliers\Enum;

enum SupplierType: int
{
    case DISTRIBUTEUR_WYZ = 1;
    case MANUFACTURIER = 2;
    case DISTRIBUTEUR_PLATEFORME = 3;
    case SPECIALISTE = 4;

    case STOCK_CENTRAL = 5;
}
