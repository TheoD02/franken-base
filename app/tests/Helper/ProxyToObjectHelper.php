<?php

namespace App\Tests\Helper;

use Zenstruck\Foundry\Proxy;

class ProxyToObjectHelper
{
    /**
     * @param array<Proxy>|Proxy $proxy
     * @return object|array
     */
    public static function proxyToObject(array|Proxy $proxy): object|array
    {
        if (is_array($proxy)) {
            return array_map(static fn(Proxy $proxy) => $proxy->object(), $proxy);
        }

        return $proxy->object();
    }
}