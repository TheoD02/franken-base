<?php

declare(strict_types=1);

namespace App\Tests\Helper;

use Zenstruck\Foundry\Proxy;

class ProxyToObjectHelper
{
    /**
     * @param array<Proxy>|Proxy $proxy
     */
    public static function proxyToObject(array|Proxy $proxy): object|array
    {
        if (\is_array($proxy)) {
            return array_map(static fn (Proxy $proxy): object => $proxy->object(), $proxy);
        }

        return $proxy->object();
    }
}
