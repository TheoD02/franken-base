<?php

declare(strict_types=1);

namespace App\Memoize;

final class MemoizeCache
{
    private static self $instance;

    private array $cache = [];

    /**
     * @var \WeakMap<object,\ArrayObject<string,mixed>>
     */
    private \WeakMap $weakMap;

    private function __construct()
    {
        $this->weakMap = new \WeakMap();
    }

    public static function getInstance(): self
    {
        return self::$instance ??= new self();
    }

    /**
     * @template T
     *
     * @param callable():T $factory
     *
     * @return T
     */
    public function get(object $object, string $key, callable $factory, bool $weak = false): mixed
    {
        $array = $weak ? $this->weakMap[$object] ??= new \ArrayObject() : ($this->cache[$object::class] ??= new \ArrayObject());

        if ($array->offsetExists($key)) {
            return $array[$key];
        }

        return $array[$key] = $factory();
    }

    public function clear(object $object, ?string $key = null): void
    {
        if (! isset($this->cache[$object::class])) {
            return;
        }

        if ($key !== null && $key !== '' && $key !== '0') {
            unset($this->cache[$object::class][$key]);

            return;
        }

        unset($this->cache[$object::class]);
    }
}
